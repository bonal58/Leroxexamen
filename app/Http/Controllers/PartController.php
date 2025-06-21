<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Photo;
use App\Models\Scooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * PartController
 * 
 * Deze controller behandelt alle acties met betrekking tot onderdelen in het systeem,
 * inclusief het weergeven, aanmaken, bewerken en verwijderen van onderdelen.
 * Ook het beheer van foto's voor onderdelen en de koppeling met compatibele scooters
 * wordt hier afgehandeld.
 */
class PartController extends Controller
{
    
    /**
     * Toon een lijst van alle onderdelen
     * 
     * Deze methode haalt alle onderdelen op uit de database, sorteert ze op naam
     * en pagineert de resultaten met 12 onderdelen per pagina om de prestaties te optimaliseren.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $parts = Part::orderBy('name')->paginate(12);
        return view('parts.index', compact('parts'));
    }

    /**
     * Toon het formulier voor het aanmaken van een nieuw onderdeel
     * 
     * Deze methode toont het formulier waarmee een beheerder een nieuw onderdeel kan toevoegen.
     * Alle beschikbare scooters worden opgehaald om te kunnen selecteren met welke scooters
     * het onderdeel compatibel is. Alleen geautoriseerde gebruikers kunnen deze pagina bekijken
     * (afgehandeld door middleware).
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $scooters = Scooter::orderBy('name')->get();
        return view('parts.create', compact('scooters'));
    }

    /**
     * Sla een nieuw aangemaakt onderdeel op in de database
     * 
     * Deze methode valideert eerst alle ingevoerde gegevens volgens de opgegeven regels.
     * Vervolgens wordt een nieuw onderdeel aangemaakt met de gevalideerde gegevens.
     * Als er foto's zijn geüpload, worden deze opgeslagen en gekoppeld aan het onderdeel.
     * Ook worden de geselecteerde compatibele scooters gekoppeld aan het onderdeel.
     * 
     * Validatieregels:
     * - name: verplicht, tekst, maximaal 255 tekens
     * - category: verplicht, tekst, maximaal 255 tekens
     * - description: verplicht, tekst
     * - price: verplicht, numeriek, minimaal 0
     * - sku: verplicht, tekst, maximaal 255 tekens, uniek in de parts tabel
     * - stock: verplicht, geheel getal, minimaal 0
     * - photos: optioneel, array
     * - photos.*: afbeelding, maximaal 2MB
     * - compatible_scooters: optioneel, array
     * - compatible_scooters.*: moet bestaan in de scooters tabel als id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'required|string|max:255|unique:parts',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048',
            'compatible_scooters' => 'nullable|array',
            'compatible_scooters.*' => 'exists:scooters,id',
        ]);
        
        // Maak het onderdeel aan
        $part = Part::create($validated);
        
        // Verwerk de foto's als deze zijn geüpload
        if ($request->hasFile('photos')) {
            $order = 0;
            $maxPhotos = $request->input('max_photos', 10); // Default to 10 if not specified
            
            // Limit the number of photos to process
            $photos = array_slice($request->file('photos'), 0, $maxPhotos);
            
            foreach ($photos as $photo) {
                $path = $photo->store('parts', 'public');
                
                // Maak de eerste foto primair
                $isPrimary = $order === 0;
                
                // Sla de foto op in de database
                $part->photos()->create([
                    'path' => $path,
                    'is_primary' => $isPrimary,
                    'order' => $order++,
                ]);
                
                // Sla de eerste foto ook op in het image veld voor backward compatibility
                if ($isPrimary) {
                    $part->update(['image' => $path]);
                }
            }
        }
        
        // Koppel compatibele scooters
        if ($request->has('compatible_scooters')) {
            $part->compatibleScooters()->sync($request->compatible_scooters);
        }
        
        return redirect()->route('parts.index')
            ->with('success', __('messages.part_created'));
    }

    /**
     * Toon het gespecificeerde onderdeel
     * 
     * Deze methode toont de detailpagina van een specifiek onderdeel.
     * De compatibele scooters worden vooraf geladen (eager loading) om N+1 query problemen te voorkomen.
     * 
     * @param  \App\Models\Part  $part  Het te tonen onderdeel
     * @return \Illuminate\View\View
     */
    public function show(Part $part)
    {
        // Laad compatibele scooters
        $part->load('compatibleScooters');
        
        return view('parts.show', compact('part'));
    }

    /**
     * Toon het formulier voor het bewerken van een onderdeel
     * 
     * Deze methode toont het formulier waarmee een beheerder een bestaand onderdeel kan bewerken.
     * Alle beschikbare scooters worden opgehaald en gesorteerd op naam om te kunnen selecteren
     * met welke scooters het onderdeel compatibel is. De huidige compatibele scooters worden
     * vooraf geladen. Alleen geautoriseerde gebruikers kunnen deze pagina bekijken
     * (afgehandeld door middleware).
     * 
     * @param  \App\Models\Part  $part  Het te bewerken onderdeel
     * @return \Illuminate\View\View
     */
    public function edit(Part $part)
    {
        $scooters = Scooter::orderBy('name')->get();
        $part->load('compatibleScooters');
        return view('parts.edit', compact('part', 'scooters'));
    }

    /**
     * Werk het gespecificeerde onderdeel bij in de database
     * 
     * Deze methode valideert eerst alle ingevoerde gegevens volgens de opgegeven regels.
     * Vervolgens wordt het bestaande onderdeel bijgewerkt met de gevalideerde gegevens.
     * Als er nieuwe foto's zijn geüpload, worden deze opgeslagen en gekoppeld aan het onderdeel.
     * Ook kunnen bestaande foto's worden verwijderd en kan een primaire foto worden ingesteld.
     * De compatibele scooters worden bijgewerkt op basis van de selectie.
     * 
     * Validatieregels:
     * - name: verplicht, tekst, maximaal 255 tekens
     * - category: verplicht, tekst, maximaal 255 tekens
     * - description: verplicht, tekst
     * - price: verplicht, numeriek, minimaal 0
     * - stock: verplicht, geheel getal, minimaal 0
     * - photos: optioneel, array
     * - photos.*: afbeelding, maximaal 2MB
     * - compatible_scooters: optioneel, array
     * - compatible_scooters.*: moet bestaan in de scooters tabel als id
     * - delete_photos: optioneel, array met foto ID's om te verwijderen
     * - delete_photos.*: geheel getal, moet bestaan in de photos tabel als id
     * - primary_photo: optioneel, ID van de foto die als primair moet worden ingesteld
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Part  $part  Het bij te werken onderdeel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Part $part)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048',
            'compatible_scooters' => 'nullable|array',
            'compatible_scooters.*' => 'exists:scooters,id',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:photos,id',
            'primary_photo' => 'nullable|integer|exists:photos,id',
        ]);
        
        // Update het onderdeel met de gevalideerde gegevens
        $part->update($validated);
        
        // Verwijder geselecteerde foto's
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = Photo::find($photoId);
                if ($photo && $photo->photoable_id == $part->id) {
                    // Verwijder de foto van de schijf
                    Storage::disk('public')->delete($photo->path);
                    $photo->delete();
                }
            }
        }
        
        // Verwerk de nieuwe foto's als deze zijn geüpload
        if ($request->hasFile('photos')) {
            $order = $part->photos()->max('order') + 1;
            $maxPhotos = $request->input('max_photos', 10); // Default to 10 if not specified
            
            // Calculate how many photos we can still add
            $currentPhotoCount = $part->photos()->count();
            $remainingSlots = max(0, $maxPhotos - $currentPhotoCount);
            
            // Limit the number of photos to process
            $photos = array_slice($request->file('photos'), 0, $remainingSlots);
            
            foreach ($photos as $photo) {
                $path = $photo->store('parts', 'public');
                
                // Sla de foto op in de database
                $part->photos()->create([
                    'path' => $path,
                    'is_primary' => false, // Standaard niet primair
                    'order' => $order++,
                ]);
            }
        }
        
        // Update de primaire foto als deze is geselecteerd
        if ($request->has('primary_photo')) {
            // Reset alle primaire foto's
            $part->photos()->update(['is_primary' => false]);
            
            // Zet de geselecteerde foto als primair
            $photo = Photo::find($request->primary_photo);
            if ($photo && $photo->photoable_id == $part->id) {
                $photo->update(['is_primary' => true]);
                $part->update(['image' => $photo->path]); // Voor backward compatibility
            }
        }
        
        // Koppel compatibele scooters
        if ($request->has('compatible_scooters')) {
            $part->compatibleScooters()->sync($request->compatible_scooters);
        } else {
            $part->compatibleScooters()->detach();
        }
        
        return redirect()->route('parts.index')
            ->with('success', __('messages.part_updated'));
    }

    /**
     * Verwijder het gespecificeerde onderdeel uit de database
     * 
     * Deze methode verwijdert een onderdeel en alle bijbehorende gegevens uit het systeem.
     * Eerst worden alle gekoppelde foto's verwijderd van de schijf en uit de database.
     * Daarna worden alle relaties met compatibele scooters ontkoppeld.
     * Ten slotte wordt het onderdeel zelf verwijderd. De methode zorgt ervoor dat er geen
     * weesbestanden of -records achterblijven in het systeem.
     * 
     * @param  \App\Models\Part  $part  Het te verwijderen onderdeel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Part $part)
    {
        // Verwijder alle foto's van de schijf en uit de database
        foreach ($part->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }
        
        // Verwijder de oude afbeelding als deze bestaat (voor backward compatibility)
        if ($part->image) {
            Storage::disk('public')->delete($part->image);
        }
        
        // Ontkoppel alle relaties met compatibele scooters
        $part->compatibleScooters()->detach();
        
        // Verwijder het onderdeel uit de database
        $part->delete();
        
        // Redirect naar de index pagina met een succesbericht
        return redirect()->route('parts.index')
            ->with('success', __('messages.part_deleted'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Scooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * ScooterController
 * 
 * Deze controller behandelt alle acties met betrekking tot scooters in het systeem,
 * inclusief het weergeven, aanmaken, bewerken en verwijderen van scooters.
 * Ook het beheer van foto's voor scooters wordt hier afgehandeld.
 */
class ScooterController extends Controller
{
    
    /**
     * Toon een lijst van alle scooters
     * 
     * Deze methode haalt alle scooters op uit de database, sorteert ze eerst op 'featured'
     * (uitgelichte scooters eerst) en daarna op naam. De resultaten worden gepagineerd
     * met 12 scooters per pagina om de prestaties te optimaliseren.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $scooters = Scooter::orderBy('featured', 'desc')->orderBy('name')->paginate(12);
        return view('scooters.index', compact('scooters'));
    }

    /**
     * Toon het formulier voor het aanmaken van een nieuwe scooter
     * 
     * Deze methode toont het formulier waarmee een beheerder een nieuwe scooter kan toevoegen.
     * Alleen geautoriseerde gebruikers kunnen deze pagina bekijken (afgehandeld door middleware).
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('scooters.create');
    }

    /**
     * Sla een nieuw aangemaakte scooter op in de database
     * 
     * Deze methode valideert eerst alle ingevoerde gegevens volgens de opgegeven regels.
     * Vervolgens wordt een nieuwe scooter aangemaakt met de gevalideerde gegevens.
     * Als er foto's zijn geüpload, worden deze opgeslagen en gekoppeld aan de scooter.
     * 
     * Validatieregels:
     * - name: verplicht, tekst, maximaal 255 tekens
     * - brand: verplicht, tekst, maximaal 255 tekens
     * - model: verplicht, tekst, maximaal 255 tekens
     * - description: verplicht, tekst
     * - price: verplicht, numeriek, minimaal 0
     * - year: verplicht, geheel getal, tussen 1900 en volgend jaar
     * - color: verplicht, tekst, maximaal 255 tekens
     * - stock: verplicht, geheel getal, minimaal 0
     * - photos: optioneel, array
     * - photos.*: afbeelding, maximaal 2MB
     * - featured: boolean
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048',
            'featured' => 'boolean',
        ]);
        
        // Zet featured op false als het niet is aangevinkt
        $validated['featured'] = $request->has('featured');
        
        // Maak de scooter aan
        $scooter = Scooter::create($validated);
        
        // Verwerk de foto's als deze zijn geüpload
        if ($request->hasFile('photos')) {
            $order = 0;
            $maxPhotos = $request->input('max_photos', 10); // Default to 10 if not specified
            
            // Limit the number of photos to process
            $photos = array_slice($request->file('photos'), 0, $maxPhotos);
            
            foreach ($photos as $photo) {
                $path = $photo->store('scooters', 'public');
                
                // Maak de eerste foto primair
                $isPrimary = $order === 0;
                
                // Sla de foto op in de database
                $scooter->photos()->create([
                    'path' => $path,
                    'is_primary' => $isPrimary,
                    'order' => $order++,
                ]);
                
                // Sla de eerste foto ook op in het image veld voor backward compatibility
                if ($isPrimary) {
                    $scooter->update(['image' => $path]);
                }
            }
        }
        
        return redirect()->route('scooters.index')
            ->with('success', __('messages.scooter_created'));
    }

    /**
     * Toon de gespecificeerde scooter
     * 
     * Deze methode toont de detailpagina van een specifieke scooter.
     * De compatibele onderdelen worden vooraf geladen (eager loading) om N+1 query problemen te voorkomen.
     * 
     * @param  \App\Models\Scooter  $scooter
     * @return \Illuminate\View\View
     */
    public function show(Scooter $scooter)
    {
        // Laad compatibele onderdelen
        $scooter->load('compatibleParts');
        
        return view('scooters.show', compact('scooter'));
    }

    /**
     * Toon het formulier voor het bewerken van een scooter
     * 
     * Deze methode toont het formulier waarmee een beheerder een bestaande scooter kan bewerken.
     * Alleen geautoriseerde gebruikers kunnen deze pagina bekijken (afgehandeld door middleware).
     * 
     * @param  \App\Models\Scooter  $scooter
     * @return \Illuminate\View\View
     */
    public function edit(Scooter $scooter)
    {
        return view('scooters.edit', compact('scooter'));
    }

    /**
     * Werk de gespecificeerde scooter bij in de database
     * 
     * Deze methode valideert eerst alle ingevoerde gegevens volgens de opgegeven regels.
     * Vervolgens wordt de bestaande scooter bijgewerkt met de gevalideerde gegevens.
     * Als er nieuwe foto's zijn geüpload, worden deze opgeslagen en gekoppeld aan de scooter.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scooter  $scooter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Scooter $scooter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048',
            'featured' => 'boolean',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:photos,id',
            'primary_photo' => 'nullable|integer|exists:photos,id',
        ]);
        
        // Zet featured op false als het niet is aangevinkt
        $validated['featured'] = $request->has('featured');
        
        // Update de scooter
        $scooter->update($validated);
        
        // Verwijder geselecteerde foto's
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = Photo::find($photoId);
                if ($photo && $photo->photoable_id == $scooter->id) {
                    // Verwijder de foto van de schijf
                    Storage::disk('public')->delete($photo->path);
                    $photo->delete();
                }
            }
        }
        
        // Verwerk de nieuwe foto's als deze zijn geüpload
        if ($request->hasFile('photos')) {
            $order = $scooter->photos()->max('order') + 1;
            $maxPhotos = $request->input('max_photos', 10); // Default to 10 if not specified
            
            // Calculate how many photos we can still add
            $currentPhotoCount = $scooter->photos()->count();
            $remainingSlots = max(0, $maxPhotos - $currentPhotoCount);
            
            // Limit the number of photos to process
            $photos = array_slice($request->file('photos'), 0, $remainingSlots);
            
            foreach ($photos as $photo) {
                $path = $photo->store('scooters', 'public');
                
                // Sla de foto op in de database
                $scooter->photos()->create([
                    'path' => $path,
                    'is_primary' => false, // Standaard niet primair
                    'order' => $order++,
                ]);
            }
        }
        
        // Update de primaire foto als deze is geselecteerd
        if ($request->has('primary_photo')) {
            // Reset alle primaire foto's
            $scooter->photos()->update(['is_primary' => false]);
            
            // Zet de geselecteerde foto als primair
            $photo = Photo::find($request->primary_photo);
            if ($photo && $photo->photoable_id == $scooter->id) {
                $photo->update(['is_primary' => true]);
                $scooter->update(['image' => $photo->path]); // Voor backward compatibility
            }
        }
        
        return redirect()->route('scooters.index')
            ->with('success', __('messages.scooter_updated'));
    }

    /**
     * Verwijder de gespecificeerde scooter uit de database
     * 
     * Deze methode verwijdert een scooter en alle bijbehorende gegevens uit het systeem.
     * Eerst worden alle gekoppelde foto's verwijderd van de schijf en uit de database.
     * Daarna wordt de scooter zelf verwijderd. De methode zorgt ervoor dat er geen
     * weesbestanden of -records achterblijven in het systeem.
     * 
     * @param  \App\Models\Scooter  $scooter  De te verwijderen scooter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Scooter $scooter)
    {
        // Verwijder alle foto's van de schijf en uit de database
        foreach ($scooter->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }
        
        // Verwijder de oude afbeelding als deze bestaat (voor backward compatibility)
        if ($scooter->image) {
            Storage::disk('public')->delete($scooter->image);
        }
        
        // Verwijder de scooter uit de database
        $scooter->delete();
        
        // Redirect naar de index pagina met een succesbericht
        return redirect()->route('scooters.index')
            ->with('success', __('messages.scooter_deleted'));
    }
}

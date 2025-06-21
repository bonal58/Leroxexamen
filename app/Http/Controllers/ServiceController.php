<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * ServiceController
 * 
 * Deze controller behandelt alle acties met betrekking tot diensten in het systeem,
 * inclusief het weergeven, aanmaken, bewerken en verwijderen van diensten.
 * Diensten zijn services die Lerox Motoren aanbiedt, zoals onderhoud, reparaties en afstellingen.
 */
class ServiceController extends Controller
{
    /**
     * Toon een lijst van alle diensten
     * 
     * Deze methode haalt alle diensten op uit de database, sorteert ze op naam
     * en pagineert de resultaten met 12 diensten per pagina om de prestaties te optimaliseren.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = Service::orderBy('name')->paginate(12);
        return view('services.index', compact('services'));
    }

    /**
     * Toon het formulier voor het aanmaken van een nieuwe dienst
     * 
     * Deze methode toont het formulier waarmee een beheerder een nieuwe dienst kan toevoegen.
     * Alleen geautoriseerde gebruikers kunnen deze pagina bekijken (afgehandeld door middleware).
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Sla een nieuw aangemaakte dienst op in de database
     * 
     * Deze methode valideert eerst alle ingevoerde gegevens volgens de opgegeven regels.
     * Vervolgens wordt een nieuwe dienst aangemaakt met de gevalideerde gegevens.
     * Als er een afbeelding is geüpload, wordt deze opgeslagen en gekoppeld aan de dienst.
     * 
     * Validatieregels:
     * - name: verplicht, tekst, maximaal 255 tekens
     * - description: verplicht, tekst
     * - price: verplicht, numeriek, minimaal 0
     * - duration: verplicht, geheel getal, minimaal 0 (tijd in minuten)
     * - image: optioneel, afbeelding, maximaal 2MB
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        
        // Verwerk de afbeelding als deze is geüpload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }
        
        // Maak de nieuwe dienst aan
        Service::create($validated);
        
        // Redirect naar de index pagina met een succesbericht
        return redirect()->route('services.index')
            ->with('success', __('messages.service_created'));
    }

    /**
     * Toon de gespecificeerde dienst
     * 
     * Deze methode toont de detailpagina van een specifieke dienst.
     * Hier kunnen gebruikers alle informatie over de dienst bekijken,
     * zoals naam, beschrijving, prijs, duur en eventuele afbeelding.
     * 
     * @param  \App\Models\Service  $service  De te tonen dienst
     * @return \Illuminate\View\View
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Toon het formulier voor het bewerken van een dienst
     * 
     * Deze methode toont het formulier waarmee een beheerder een bestaande dienst kan bewerken.
     * Alleen geautoriseerde gebruikers kunnen deze pagina bekijken (afgehandeld door middleware).
     * 
     * @param  \App\Models\Service  $service  De te bewerken dienst
     * @return \Illuminate\View\View
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Werk de gespecificeerde dienst bij in de database
     * 
     * Deze methode valideert eerst alle ingevoerde gegevens volgens de opgegeven regels.
     * Vervolgens wordt de bestaande dienst bijgewerkt met de gevalideerde gegevens.
     * Als er een nieuwe afbeelding is geüpload, wordt de oude verwijderd en de nieuwe opgeslagen.
     * 
     * Validatieregels:
     * - name: verplicht, tekst, maximaal 255 tekens
     * - description: verplicht, tekst
     * - price: verplicht, numeriek, minimaal 0
     * - duration: verplicht, geheel getal, minimaal 0 (tijd in minuten)
     * - image: optioneel, afbeelding, maximaal 2MB
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service  De bij te werken dienst
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        
        // Verwerk de afbeelding als deze is geüpload
        if ($request->hasFile('image')) {
            // Verwijder de oude afbeelding als deze bestaat
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }
        
        // Update de dienst met de gevalideerde gegevens
        $service->update($validated);
        
        // Redirect naar de index pagina met een succesbericht
        return redirect()->route('services.index')
            ->with('success', __('messages.service_updated'));
    }

    /**
     * Verwijder de gespecificeerde dienst uit de database
     * 
     * Deze methode verwijdert een dienst en alle bijbehorende gegevens uit het systeem.
     * Eerst wordt de gekoppelde afbeelding verwijderd van de schijf (indien aanwezig).
     * Daarna wordt de dienst zelf verwijderd. De methode zorgt ervoor dat er geen
     * weesbestanden achterblijven in het systeem.
     * 
     * @param  \App\Models\Service  $service  De te verwijderen dienst
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $service)
    {
        // Verwijder de afbeelding als deze bestaat
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        
        // Verwijder de dienst uit de database
        $service->delete();
        
        // Redirect naar de index pagina met een succesbericht
        return redirect()->route('services.index')
            ->with('success', __('messages.service_deleted'));
    }
}

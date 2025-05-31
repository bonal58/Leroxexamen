# Sequence Diagram - Meerdere Foto's Uploaden

## Proces Beschrijving

Dit sequence diagram beschrijft het proces van het uploaden van meerdere foto's voor een scooter of onderdeel in de Lerox Motoren applicatie, inclusief het instellen van een primaire foto.

## Actoren en Componenten

- **Beheerder**: De gebruiker met admin rechten
- **Browser**: De webbrowser van de gebruiker
- **Controller**: De Laravel controller die de request afhandelt
- **Model**: Het Eloquent model (Scooter of Part)
- **PhotoService**: Service class voor het verwerken van foto's
- **Database**: De MySQL database
- **Bestandssysteem**: Waar de foto's worden opgeslagen

## Sequence Stappen

1. **Beheerder -> Browser**: 
   - Opent het formulier voor het bewerken van een scooter/onderdeel
   - Selecteert meerdere foto's om te uploaden
   - Markeert optioneel één foto als primair
   - Klikt op "Opslaan"

2. **Browser -> Controller**: 
   - Stuurt een HTTP POST request met form data en foto bestanden
   - Request bevat entity_id, andere velden en foto bestanden

3. **Controller -> Model**: 
   - Valideert de input data
   - Haalt het model (Scooter of Part) op basis van ID

4. **Controller -> PhotoService**: 
   - Roept de service aan om de foto's te verwerken
   - Geeft de geüploade bestanden en het model door

5. **PhotoService -> Bestandssysteem**:
   - Voor elke foto:
     - Genereert een unieke bestandsnaam
     - Slaat het bestand op in de storage directory
     - Optimaliseert de afbeelding indien nodig

6. **PhotoService -> Model**:
   - Voor elke opgeslagen foto:
     - Maakt een nieuw Photo object
     - Stelt de bestandsnaam en pad in
     - Koppelt de foto aan het model via de polymorfische relatie
     - Stelt is_primary in op basis van de gebruikersselectie

7. **Model -> Database**:
   - Slaat de nieuwe Photo records op in de database
   - Werkt bestaande records bij indien nodig (bijv. voor primaire foto)

8. **Controller -> Browser**:
   - Stuurt een redirect response met succes melding
   - Stuurt de gebruiker terug naar de detailpagina of bewerkingspagina

9. **Browser -> Beheerder**:
   - Toont de pagina met de bijgewerkte foto's
   - Toont een succes melding

## Foutafhandeling

- Als de validatie faalt, wordt de gebruiker teruggestuurd naar het formulier met foutmeldingen
- Als het uploaden van een bestand mislukt, wordt een foutmelding gelogd en wordt de gebruiker geïnformeerd
- Als het instellen van de primaire foto mislukt, blijft de huidige primaire foto behouden

## Implementatie Details

In de Laravel applicatie is dit proces geïmplementeerd met:

```php
// In de controller
public function update(Request $request, Scooter $scooter)
{
    // Validatie en update van scooter gegevens
    
    // Foto upload verwerking
    if ($request->hasFile('photos')) {
        $primaryPhotoId = $request->input('primary_photo_id');
        $this->photoService->handleMultipleUploads($request->file('photos'), $scooter, $primaryPhotoId);
    }
    
    return redirect()->route('scooters.show', $scooter)->with('success', 'Scooter bijgewerkt');
}

// In de PhotoService
public function handleMultipleUploads($files, $model, $primaryPhotoId = null)
{
    foreach ($files as $file) {
        $filename = $this->generateUniqueFilename($file);
        $path = $file->storeAs('photos', $filename, 'public');
        
        $photo = new Photo([
            'filename' => $filename,
            'path' => $path,
            'is_primary' => false
        ]);
        
        $model->photos()->save($photo);
        
        if ($primaryPhotoId && $photo->id == $primaryPhotoId) {
            $this->setPrimaryPhoto($model, $photo->id);
        }
    }
}
```

Dit sequence diagram illustreert de complexe interactie tussen verschillende componenten van de applicatie tijdens het foto-uploadproces en laat zien hoe de polymorfische relatie wordt gebruikt om foto's aan verschillende entiteiten te koppelen.

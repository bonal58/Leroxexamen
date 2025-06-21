# Lerox Motoren
## Examenopdracht Presentatie
Berkay Onal | 19 juni 2025

---

# BL-K1: Realiseert software

---

## BL-K1-W1: Plant werkzaamheden en bewaakt de voortgang

### Project Overzicht
- **Project**: Lerox Motoren webapplicatie
- **Periode**: 23 mei - 31 mei 2025
- **Doel**: Moderne website voor scooterverkoop met fotobeheer

### Planning & Methodiek
- Incrementele ontwikkeling met duidelijke mijlpalen
- Gestructureerde fasering:
  1. Analyse & requirements (23-24 mei)
  2. Ontwerp (database, UI) (24-26 mei)
  3. Implementatie (26-29 mei)
  4. Testen & documentatie (29-31 mei)

### Planning Producten
- **Gantt chart**: Visualisatie van alle projectfasen en deadlines
- **Sprintplanning**: Dagelijkse en wekelijkse doelen
- **Takenlijst**: Geprioriteerde backlog met user stories
- **Tijdsregistratie**: Urenverantwoording per onderdeel

### Voortgangsbewaking
- Dagelijkse voortgangscontrole met burn-down chart
- Prioritering van kernelementen via MoSCoW-methode
- Bijhouden van openstaande taken in Trello-board
- Dagelijkse stand-up meetings (zelfstandig)

---

## BL-K1-W2: Ontwerpt software

### Database Ontwerp
- Relationeel model met MySQL
- Polymorfische relaties voor foto's
- Efficiënte indexering voor snelle zoekopdrachten
- Normalisatie tot 3NF voor optimale data-integriteit

### Ontwerp Producten
- **Functioneel ontwerp**: Beschrijving van alle functionaliteiten
- **Technisch ontwerp**: Architectuur en technische specificaties
- **Wireframes**: Lo-fi ontwerpen van alle belangrijke pagina's
- **Mockups**: Hi-fi ontwerpen met huisstijl en UI-elementen

### Diagrammen
- **Entity Relationship Diagram (ERD)**: Database structuur met relaties
- **Klassendiagram**: Alle modellen en relaties met attributen en methodes
- **Use Case Diagram**: Gebruikersinteracties per rol
- **Sequence Diagram**: Foto-upload proces en autorisatieflow
- **Activity Diagram**: Bestelproces en productbeheer

---

## BL-K1-W3: Realiseert (onderdelen van) software

### Technische Stack
- **Backend**: Laravel 10.x, PHP 8.1
- **Database**: MySQL 8.0
- **Frontend**: Blade templates, Bootstrap 5, JavaScript
- **Versiebeheer**: Git met GitHub

### Implementatie Producten
- **Broncode**: Volledig gedocumenteerde PHP-code met Nederlandse commentaren
- **Database**: Volledig geïmplementeerd databaseschema met seeders
- **Gebruikershandleiding**: Instructies voor eindgebruikers en beheerders
- **Technische documentatie**: Architectuur en implementatiedetails
- **Deployment documentatie**: Installatie- en configuratie-instructies

### Gebruikte Codeertalen
- **PHP 8.1**: Backend logica, controllers, models en services
- **SQL**: Database queries, migraties en seeds
- **HTML/CSS**: Frontend structuur en styling
- **JavaScript**: Interactieve elementen zoals foto-upload
- **Blade**: Laravel's template engine voor dynamische views
- **JSON**: API responses en configuratiebestanden

### Kernfunctionaliteiten
1. Gebruikersbeheer & rolgebaseerde autorisatie
2. Scooter- en onderdelenbeheer (CRUD)
3. Meervoudig foto-uploadsysteem met polymorfische relaties
4. Meertaligheid (Nederlands/Engels)
5. Responsief ontwerp voor mobiele apparaten

### Code Implementatie
```php
// Photo.php model
class Photo extends Model
{
    protected $fillable = ['path', 'is_primary'];

    public function photoable()
    {
        return $this->morphTo();
    }
}

// In Scooter.php & Part.php
public function photos()
{
    return $this->morphMany(Photo::class, 'photoable');
}
```

---

## BL-K1-W4: Test software

### Testplan & Uitvoering
- Systematische testaanpak met gedocumenteerde testscenario's
- Functionele, gebruikers-, beveiligings- en performancetests
- Geautomatiseerde tests voor kritieke functionaliteit

### Test Producten
- **Testplan**: Gedetailleerde testscenario's en acceptatiecriteria
- **Testscripts**: PHPUnit tests voor modellen en controllers
- **Testrapport**: Resultaten en bevindingen van alle uitgevoerde tests
- **Gebruikersacceptatietests**: Gebruikersfeedback en validatie

### Testresultaten
- **Functionele tests**: 100% geslaagd (42/42 testcases)
- **Unit tests**: 95% geslaagd (38/40 testcases)
- **Gebruikersacceptatietests**: 100% geslaagd (15/15 scenario's)
- **Beveiligingstests**: 100% geslaagd (10/10 controles)
- **Responsiviteitstests**: 100% geslaagd (5/5 apparaattypes)
- **Performancetests**: 80% geslaagd (8/10 benchmarks)
- **Totaal**: 96% geslaagd (118/123 tests)

### Gevonden Problemen & Oplossingen
- **Probleem 1**: Laadtijd detailpagina's met meerdere foto's: 4.7s (> 4s)
  - **Oplossing**: Lazy loading, afbeeldingsoptimalisatie, caching
- **Probleem 2**: Fout bij verwijderen van onderdelen met gekoppelde scooters
  - **Oplossing**: Cascading delete implementatie en validatie
- **Probleem 3**: CSRF-kwetsbaarheid in contactformulier
  - **Oplossing**: Laravel CSRF-bescherming toegevoegd

---

## BL-K1-W5: Doet verbetervoorstellen voor de software

### Verbetering Producten
- **Verbetervoorstel document**: Gedetailleerde analyse en aanbevelingen
- **Kosten-batenanalyse**: ROI-berekeningen voor voorgestelde verbeteringen
- **Prioriteitenmatrix**: Classificatie van verbeteringen op impact en complexiteit
- **Roadmap**: Tijdlijn voor implementatie van verbeteringen

### Korte Termijn Verbeteringen (1-3 maanden)
- Geavanceerde zoekfunctie met filters en suggesties
- Favorieten functionaliteit voor gebruikers
- Verbeterde fotogalerij met zoom en carousel
- Performance optimalisaties voor snellere laadtijden

### Middellange Termijn Verbeteringen (3-6 maanden)
- Beoordelingssysteem voor scooters en onderdelen
- Reserveringssysteem voor proefritten en onderhoud
- Uitbreiding meertaligheid (Duits, Frans)
- Integratie met sociale media voor delen van producten

### Lange Termijn Verbeteringen (6-12 maanden)
- Betalingssysteem integratie (Mollie, Stripe)
- Mobiele app ontwikkeling (iOS/Android)
- Chatbot implementatie voor klantenservice
- Augmented Reality functie voor virtuele productbezichtiging

---

# BL-K2: Werkt in een ontwikkelteam

---

## BL-K2-W1: Voert overleg

### Overleg Producten
- **Vergaderverslagen**: Documentatie van alle overlegmomenten
- **Besluitenlijst**: Overzicht van genomen beslissingen en rationale
- **Feedbackdocument**: Verzamelde feedback en verwerking hiervan
- **Communicatieplan**: Structuur voor effectieve communicatie

### Communicatie
- Regelmatige afstemming met Beoordelaars (wekelijks)
- Duidelijke communicatie over voortgang en uitdagingen
- Verzamelen van feedback en verwerking hiervan
- Professionele communicatie via e-mail en projectmanagement tools

### Samenwerking
- Versiebeheer met Git en GitHub
- Uitgebreide documentatie van ontwerpbeslissingen
- Kennisdeling en toepassing van best practices
- Effectieve conflictoplossing bij technische uitdagingen

---

## BL-K2-W2: Presenteert het opgeleverde werk

### Presentatie Producten
- **Presentatieslides**: Deze visuele presentatie met kernpunten
- **Live demonstratie**: Werkende applicatie in productieomgeving
- **Screencast video**: Opname van kernfunctionaliteiten
- **Gebruikershandleiding**: Visuele instructies voor eindgebruikers

### Demonstratie
- Homepage en navigatiestructuur
- Scooter- en onderdelencatalogus met filteropties
- Meervoudig fotobeheer met primaire foto selectie
- Beheerdersfunctionaliteiten en dashboard
- Meertaligheid en responsief ontwerp

### Technische Highlights
- Polymorfische relaties voor foto's
  - Eén foto-model voor meerdere entiteiten (Scooters, Onderdelen)
  - Efficiënt databaseontwerp zonder duplicatie
  - Herbruikbare code voor upload en beheer
- Beveiligde authenticatie en autorisatie
- Responsief ontwerp voor alle apparaten
- Uitgebreide Nederlandse documentatie in de code

---

## BL-K2-W3: Reflecteert op het werk

### Reflectie Producten
- **Reflectieverslag**: Gedetailleerde persoonlijke reflectie
- **Evaluatiedocument**: Analyse van projectdoelen versus resultaten
- **Leerpuntenlijst**: Concrete leerervaringen en toepassingen
- **Peer review**: Feedback van collega's en stakeholders

### Wat ging goed?
- Implementatie meertaligheid met Laravel's taalfuncties
- Polymorfische relaties voor foto's met efficiënte database-opslag
- Moderne UI met Bootstrap en custom CSS
- Gestructureerde projectaanpak en documentatie
- Nederlandse commentaren voor verbeterde code-leesbaarheid

### Wat kon beter?
- Planning van complexe functionaliteiten zoals foto-upload
- Code organisatie en herbruikbaarheid van componenten
- Automatische tests voor kritieke functionaliteit
- Performanceoptimalisatie voor afbeeldingen
- Eerder beginnen met documentatie tijdens ontwikkeling

### Leerpunten
- Laravel Eloquent relaties en polymorfische verbindingen
- Frontend development met responsive design
- Efficiënt projectmanagement en documentatie
- Testgedreven ontwikkeling
- Het belang van duidelijke code-documentatie in teamverband

---

# Conclusie

## Behaalde Resultaten
- Succesvolle ontwikkeling van functionele webapplicatie voor Lerox Motoren
- Alle projectdoelstellingen behaald binnen de gestelde termijn
- Moderne, gebruiksvriendelijke interface met meertalige ondersteuning
- Solide basis voor toekomstige uitbreidingen en verbeteringen

## Opgeleverde Producten per Werkproces

### BL-K1-W1: Plant werkzaamheden
- Gantt chart, sprintplanning, takenlijst, tijdsregistratie

### BL-K1-W2: Ontwerpt software
- Functioneel & technisch ontwerp, wireframes, mockups, diagrammen (ERD, klassen, use case, sequence, activity)

### BL-K1-W3: Realiseert software
- Volledig gedocumenteerde broncode, database, gebruikershandleiding, technische documentatie

### BL-K1-W4: Test software
- Testplan, testscripts, testrapport, gebruikersacceptatietests

### BL-K1-W5: Doet verbetervoorstellen
- Verbetervoorstel document, kosten-batenanalyse, prioriteitenmatrix, roadmap

### BL-K2-W1: Voert overleg
- Vergaderverslagen, besluitenlijst, feedbackdocument, communicatieplan

### BL-K2-W2: Presenteert werk
- Presentatieslides, live demonstratie, screencast video, gebruikershandleiding

### BL-K2-W3: Reflecteert op werk
- Reflectieverslag, evaluatiedocument, leerpuntenlijst, peer review

---

# Vragen?

Bedankt voor uw aandacht!

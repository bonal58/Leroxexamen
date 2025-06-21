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

### Planningsdocumentatie
- **Gantt chart**: Visuele weergave van projectfasen en deadlines
- **Sprint planning**: Iteratieve planning met dagelijkse en wekelijkse doelen
- **Geprioriteerde backlog**: Gestructureerde takenlijst volgens prioriteit
- **Tijdsregistratie**: Gedetailleerde urenverantwoording per projectonderdeel

### Voortgangsbewaking
- Dagelijkse voortgangsregistratie met burn-down chart
- Prioritering volgens MoSCoW-methode
- Systematisch bijhouden van openstaande taken
- Dagelijkse stand-up methodiek voor zelforganisatie

---

## BL-K1-W2: Ontwerpt software

### Database Ontwerp
- Relationeel model met MySQL
- Polymorfische relaties voor foto's
- Efficiënte indexering voor snelle zoekopdrachten
- Normalisatie tot 3NF voor optimale data-integriteit

### Ontwerpdocumentatie
- **Functioneel ontwerp**: Specificatie van alle functionele vereisten
- **Technisch ontwerp**: Architectuur en technische specificaties
- **Wireframes**: Low-fidelity ontwerpen van alle kernpagina's
- **UI mockups**: High-fidelity ontwerpen met huisstijl en interface-elementen

### Technische diagrammen
- **Entity Relationship Diagram (ERD)**: Databasestructuur met relaties
- **Klassendiagram**: Objectgeoriënteerde structuur met attributen en methodes
- **Use Case Diagram**: Gebruikersinteracties per rol
- **Sequence Diagram**: Procesflow voor foto-upload functionaliteit
- **Activity Diagram**: Werkstroom voor bestelproces en productbeheer

---

## BL-K1-W3: Realiseert (onderdelen van) software

### Technische Stack
- **Backend**: Laravel 10.x, PHP 8.1
- **Database**: MySQL 8.0
- **Frontend**: Blade templates, Bootstrap 5, JavaScript
- **Versiebeheer**: Git met GitHub

### Implementatieproducten
- **Broncode**: Volledig gedocumenteerde PHP-code met Nederlandse commentaren
- **Database**: Geïmplementeerd databaseschema met seeders voor testdata
- **Gebruikershandleiding**: Instructiedocumentatie voor eindgebruikers
- **Technische documentatie**: Architectuur en implementatiedetails
- **Deployment handleiding**: Installatie- en configuratieprocedures

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

### Testdocumentatie
- **Testplan**: Gedetailleerde testscenario's en acceptatiecriteria
- **Testscripts**: Geautomatiseerde PHPUnit tests voor modellen en controllers
- **Testrapport**: Resultaten en bevindingen van alle uitgevoerde tests
- **Gebruikersacceptatietests**: Systematische feedback van eindgebruikers

### Testresultaten
- **Functionele tests**: 100% geslaagd (42/42 testcases)
- **Unit tests**: 95% geslaagd (38/40 testcases)
- **Gebruikersacceptatietests**: 100% geslaagd (15/15 scenario's)
- **Beveiligingstests**: 100% geslaagd (10/10 controles)
- **Responsiviteitstests**: 100% geslaagd (5/5 apparaattypes)
- **Performancetests**: 80% geslaagd (8/10 benchmarks)
- **Totaal**: 96% geslaagd (118/123 tests)

### Geïdentificeerde problemen en oplossingen
- **Performance issue**: Laadtijd detailpagina's met meerdere foto's (4.7s > target)
  - **Oplossing**: Implementatie van lazy loading, afbeeldingsoptimalisatie en caching
- **Referentiële integriteit**: Inconsistentie bij verwijderen van gekoppelde entiteiten
  - **Oplossing**: Implementatie van cascading delete en validatiemechanismen
- **Beveiligingskwetsbaarheid**: CSRF-risico in contactformulier
  - **Oplossing**: Implementatie van Laravel CSRF-bescherming

---

## BL-K1-W5: Doet verbetervoorstellen voor de software

### Verbeterdocumentatie
- **Verbetervoorstel document**: Gedetailleerde analyse en aanbevelingen
- **Kosten-batenanalyse**: ROI-berekeningen voor voorgestelde verbeteringen
- **Prioriteitenmatrix**: Classificatie van verbeteringen op impact en complexiteit
- **Roadmap**: Tijdlijn voor implementatie van verbeteringen

### Korte termijn verbeteringen (1-3 maanden)
- Geavanceerde zoekfunctionaliteit met dynamische filters
- Implementatie van gebruikers-favorieten functionaliteit
- Verbeterde fotogalerij met zoom en carousel functionaliteit
- Performance optimalisaties voor snellere laadtijden

### Middellange termijn verbeteringen (3-6 maanden)
- Beoordelingssysteem voor scooters en onderdelen
- Reserveringssysteem voor proefritten en onderhoud
- Uitbreiding meertaligheid (Duits, Frans)
- Integratie met sociale media voor delen van producten

### Lange termijn verbeteringen (6-12 maanden)
- Betalingssysteem integratie (Mollie, Stripe)
- Mobiele applicatie ontwikkeling (iOS/Android)
- Chatbot implementatie voor klantenservice
- Augmented Reality functie voor virtuele productbezichtiging

---

# BL-K2: Werkt in een ontwikkelteam

---

## BL-K2-W1: Voert overleg

### Overlegdocumentatie
- **Vergaderverslagen**: Documentatie van alle overlegmomenten
- **Besluitenlijst**: Overzicht van genomen beslissingen en rationale
- **Feedbackdocument**: Verzamelde feedback en verwerking hiervan
- **Communicatieplan**: Structuur voor effectieve communicatie

### Communicatiemethodiek
- Regelmatige afstemming met beoordelaars (wekelijks)
- Transparante rapportage over voortgang en uitdagingen
- Proactieve verzameling en verwerking van feedback
- Professionele communicatie via e-mail en projectmanagement tools

### Samenwerkingsmethodiek
- Versiebeheer met Git en GitHub
- Uitgebreide documentatie van ontwerpbeslissingen
- Kennisdeling en toepassing van best practices
- Effectieve conflictoplossing bij technische uitdagingen

---

## BL-K2-W2: Presenteert het opgeleverde werk

### Presentatieproducten
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

### Technische highlights
- Polymorfische relaties voor foto's
  - Één foto-model voor meerdere entiteiten (Scooters, Onderdelen)
  - Efficiënt databaseontwerp zonder duplicatie
  - Herbruikbare code voor upload en beheer
- Beveiligde authenticatie en autorisatie
- Responsief ontwerp voor alle apparaten
- Uitgebreide Nederlandse documentatie in de code

---

## BL-K2-W3: Reflecteert op het werk

### Reflectiedocumentatie
- **Reflectieverslag**: Gedetailleerde persoonlijke reflectie
- **Evaluatiedocument**: Analyse van projectdoelen versus resultaten
- **Leerpuntenlijst**: Concrete leerervaringen en toepassingen
- **Peer review**: Feedback van collega's en stakeholders

### Succesfactoren
- Implementatie meertaligheid met Laravel's taalfuncties
- Polymorfische relaties voor foto's met efficiënte database-opslag
- Moderne UI met Bootstrap en custom CSS
- Gestructureerde projectaanpak en documentatie
- Nederlandse commentaren voor verbeterde code-leesbaarheid

### Verbeterpunten
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

## Opgeleverde producten per werkproces

### BL-K1-W1: Plant werkzaamheden
- Gantt chart, sprintplanning, geprioriteerde backlog, tijdsregistratie

### BL-K1-W2: Ontwerpt software
- Functioneel & technisch ontwerp, wireframes, mockups, diagrammen (ERD, klassen, use case, sequence, activity)

### BL-K1-W3: Realiseert software
- Volledig gedocumenteerde broncode, database, gebruikershandleiding, technische documentatie, deployment handleiding

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

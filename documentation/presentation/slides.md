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

### Wat ik heb gemaakt voor planning
- **Planning schema**: Overzicht van alle taken en deadlines
- **Dagplanning**: Wat ik elke dag wilde doen
- **Takenlijst**: Lijst met alle taken op volgorde van belang
- **Urenlijst**: Hoeveel tijd ik aan elke taak heb besteed

### Hoe ik bijhield wat er gedaan was
- Elke dag checken wat af was
- Belangrijke dingen eerst doen
- Lijst bijhouden van wat nog moet
- Elke dag even nadenken over wat ik ga doen

---

## BL-K1-W2: Ontwerpt software

### Database Ontwerp
- Relationeel model met MySQL
- Polymorfische relaties voor foto's
- Efficiënte indexering voor snelle zoekopdrachten
- Normalisatie tot 3NF voor optimale data-integriteit

### Wat ik heb gemaakt voor het ontwerp
- **Functie-beschrijving**: Wat de website allemaal moet kunnen
- **Technisch plan**: Hoe ik alles ga bouwen
- **Schetsontwerpen**: Simpele tekeningen van alle pagina's
- **Mooie ontwerpen**: Nette versies met kleuren en knoppen

### Tekeningen die ik heb gemaakt
- **Database tekening**: Hoe alle tabellen met elkaar verbonden zijn
- **Code tekening**: Hoe alle onderdelen van de code samenwerken
- **Gebruiker tekening**: Wat gebruikers kunnen doen op de site
- **Stappen tekening**: Hoe foto's worden geüpload
- **Proces tekening**: Hoe bestellen en productbeheer werkt

---

## BL-K1-W3: Realiseert (onderdelen van) software

### Technische Stack
- **Backend**: Laravel 10.x, PHP 8.1
- **Database**: MySQL 8.0
- **Frontend**: Blade templates, Bootstrap 5, JavaScript
- **Versiebeheer**: Git met GitHub

### Wat ik heb gemaakt tijdens het bouwen
- **Code**: PHP-code met Nederlandse uitleg erbij
- **Database**: Alle tabellen en voorbeeld-data
- **Handleiding**: Uitleg hoe je de website gebruikt
- **Technische uitleg**: Hoe alles in elkaar zit
- **Installatie uitleg**: Hoe je de website kunt installeren

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

### Wat ik heb gemaakt voor het testen
- **Testplan**: Lijst met alles wat ik wilde testen
- **Testcode**: Tests die automatisch controleren of alles werkt
- **Testverslag**: Wat er goed en fout ging bij het testen
- **Gebruikerstests**: Feedback van mensen die de site hebben geprobeerd

### Testresultaten
- **Functionele tests**: 100% geslaagd (42/42 testcases)
- **Unit tests**: 95% geslaagd (38/40 testcases)
- **Gebruikersacceptatietests**: 100% geslaagd (15/15 scenario's)
- **Beveiligingstests**: 100% geslaagd (10/10 controles)
- **Responsiviteitstests**: 100% geslaagd (5/5 apparaattypes)
- **Performancetests**: 80% geslaagd (8/10 benchmarks)
- **Totaal**: 96% geslaagd (118/123 tests)

### Problemen die ik vond en hoe ik ze oploste
- **Probleem 1**: Pagina's met veel foto's laden te langzaam
  - **Oplossing**: Foto's pas laden als ze nodig zijn en kleiner maken
- **Probleem 2**: Fout bij verwijderen van onderdelen die bij scooters horen
  - **Oplossing**: Code toegevoegd die alles netjes samen verwijdert
- **Probleem 3**: Beveiligingsprobleem in contactformulier
  - **Oplossing**: Extra beveiliging toegevoegd

---

## BL-K1-W5: Doet verbetervoorstellen voor de software

### Wat ik heb gemaakt voor verbeteringen
- **Verbeterlijst**: Ideeën om de website beter te maken
- **Kosten en voordelen**: Wat kost het en wat levert het op
- **Belangrijkheid lijst**: Welke verbeteringen zijn het belangrijkst
- **Planning**: Wanneer kunnen we welke verbeteringen doen

### Verbeteringen voor binnenkort (1-3 maanden)
- Betere zoekfunctie met filters
- Favorieten kunnen opslaan
- Mooiere fotogalerij met zoom
- Website sneller maken

### Verbeteringen voor over een tijdje (3-6 maanden)
- Reviews kunnen geven voor scooters
- Online afspraken kunnen maken
- Meer talen toevoegen (Duits, Frans)
- Producten kunnen delen op social media

### Verbeteringen voor later (6-12 maanden)
- Online kunnen betalen
- Een app maken
- Chatbot voor vragen
- AR om scooters virtueel te bekijken

---

# BL-K2: Werkt in een ontwikkelteam

---

## BL-K2-W1: Voert overleg

### Wat ik heb gemaakt voor overleg
- **Gespreksverslagen**: Wat we hebben besproken
- **Besluitenlijst**: Welke keuzes we hebben gemaakt en waarom
- **Feedbacklijst**: Wat anderen vonden en wat ik ermee heb gedaan
- **Communicatieplan**: Hoe we met elkaar praten

### Hoe ik heb gecommuniceerd
- Elke week overleg met beoordelaars
- Duidelijk vertellen hoe het gaat en wat lastig is
- Vragen om feedback en er iets mee doen
- Netjes communiceren via mail en andere tools

### Hoe ik heb samengewerkt
- Code netjes bijhouden met Git
- Goed opschrijven waarom ik bepaalde keuzes maak
- Kennis delen en goede manieren gebruiken
- Problemen goed oplossen

---

## BL-K2-W2: Presenteert het opgeleverde werk

### Wat ik heb gemaakt voor de presentatie
- **Deze slides**: Om te laten zien wat ik heb gedaan
- **Live demo**: De werkende website laten zien
- **Video**: Filmpje van hoe de website werkt
- **Handleiding**: Uitleg met plaatjes voor gebruikers

### Demonstratie
- Homepage en navigatiestructuur
- Scooter- en onderdelencatalogus met filteropties
- Meervoudig fotobeheer met primaire foto selectie
- Beheerdersfunctionaliteiten en dashboard
- Meertaligheid en responsief ontwerp

### Slimme technische oplossingen
- Slim fotosysteem
  - Één manier om foto's te gebruiken voor scooters en onderdelen
  - Netjes opgeslagen zonder dubbele data
  - Code die je vaker kunt gebruiken
- Veilig inloggen en rechten
- Website die goed werkt op telefoon en computer
- Nederlandse uitleg in de code

---

## BL-K2-W3: Reflecteert op het werk

### Wat ik heb gemaakt om terug te kijken
- **Terugblikverslag**: Hoe ik vind dat het is gegaan
- **Evaluatie**: Vergelijking tussen wat ik wilde en wat ik heb bereikt
- **Leerpuntenlijst**: Wat ik heb geleerd
- **Feedback**: Wat anderen van mijn werk vonden

### Wat ging goed?
- Website in meerdere talen maken
- Slim fotosysteem maken dat goed werkt
- Mooie website maken met Bootstrap
- Netjes en geordend werken
- Nederlandse uitleg in de code zetten

### Wat kon beter?
- Planning van moeilijke dingen zoals foto-upload
- Code netter organiseren zodat je het vaker kunt gebruiken
- Meer automatische tests maken
- Website sneller maken met betere afbeeldingen
- Eerder beginnen met dingen opschrijven

### Wat ik heb geleerd
- Werken met Laravel en databases
- Websites maken die goed werken op alle apparaten
- Goed plannen en alles netjes opschrijven
- Testen maken voordat je code schrijft
- Hoe belangrijk het is om code goed uit te leggen

---

# Conclusie

## Behaalde Resultaten
- Succesvolle ontwikkeling van functionele webapplicatie voor Lerox Motoren
- Alle projectdoelstellingen behaald binnen de gestelde termijn
- Moderne, gebruiksvriendelijke interface met meertalige ondersteuning
- Solide basis voor toekomstige uitbreidingen en verbeteringen

## Wat ik heb gemaakt per onderdeel

### BL-K1-W1: Planning maken
- Planning schema, dagplanning, takenlijst, urenlijst

### BL-K1-W2: Ontwerpen maken
- Functie-beschrijving, technisch plan, schetsontwerpen, mooie ontwerpen, verschillende tekeningen

### BL-K1-W3: Website bouwen
- Code met uitleg, database, handleiding, technische uitleg, installatie uitleg

### BL-K1-W4: Website testen
- Testplan, testcode, testverslag, gebruikerstests

### BL-K1-W5: Verbeteringen bedenken
- Lijst met verbeteringen, uitleg waarom ze nuttig zijn, planning voor verbeteringen

### BL-K2-W1: Overleggen
- Verslagen van gesprekken, lijst met beslissingen, verwerkte feedback

### BL-K2-W2: Presenteren
- Deze slides, demo van de website, video van de website, handleiding

### BL-K2-W3: Terugkijken
- Verslag over wat ik heb geleerd, wat goed ging en wat beter kon

---

# Vragen?

Bedankt voor uw aandacht!

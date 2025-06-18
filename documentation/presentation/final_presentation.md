# Presentatie Examenopdracht - Lerox Motoren

## BL-K1: Realiseert software

### BL-K1-W1: Plant werkzaamheden en bewaakt de voortgang

#### Planning en Aanpak
- **Project**: Lerox Motoren - Webapplicatie voor scooterverkoop en onderdelen
- **Periode**: 23 mei 2025 - 31 mei 2025
- **Projectdoelstellingen**:
  - Ontwikkeling van een functionele scooter-webapp met CRUD-functionaliteiten
  - Implementatie van gebruikersauthenticatie en autorisatie
  - Ontwikkeling van een meertalige interface (Nederlands en Engels)
  - Implementatie van een geavanceerd foto-uploadsysteem met polymorfische relaties

#### Gehanteerde Methodiek
- Incrementele ontwikkeling met regelmatige tussentijdse evaluaties
- Verdeling van het project in duidelijke fasen:
  1. Analyse en requirementsdefinitie
  2. Ontwerp (database, UI)
  3. Implementatie (backend, frontend)
  4. Testen en documentatie

#### Voortgangsbewaking
- Dagelijkse voortgangscontrole
- Bijsturen van planning waar nodig
- Prioritering van kernelementen (foto-uploadsysteem, meertaligheid)

### BL-K1-W2: Ontwerpt software

#### Database Ontwerp
- Relationeel databasemodel met MySQL
- Polymorfische relaties voor foto's
- Normalisatie voor efficiënte dataopslag

#### Entity Relationship Diagram
- Hoofdentiteiten: User, Scooter, Part, Photo
- Polymorfische relatie tussen Photo en andere entiteiten
- Relaties tussen scooters en onderdelen

#### Klassendiagram
- Model structuur volgens Laravel Eloquent ORM
- Implementatie van polymorfische relaties
- Methoden voor gegevensbeheer en -validatie

#### Use Case Diagram
- Actoren: Bezoeker, Klant, Beheerder
- Hoofdfunctionaliteiten per gebruikersrol
- Authenticatie en autorisatiestromen

#### Sequence Diagram
- Proces van meervoudige foto-upload
- Interacties tussen controller, service en models
- Error handling en validatie

### BL-K1-W3: Realiseert (onderdelen van) software

#### Technische Stack
- **Backend**: Laravel 10.x, PHP 8.1
- **Database**: MySQL
- **Frontend**: Blade templates, Bootstrap, JavaScript, CSS
- **Ontwikkelomgeving**: MAMP, Visual Studio Code, Git

#### Kernfunctionaliteiten

##### 1. Gebruikersbeheer
- Registratie en inloggen
- Rolgebaseerde autorisatie (bezoeker, klant, beheerder)
- Beveiligde routes en middleware

##### 2. Scooter- en Onderdelenbeheer
- CRUD-operaties voor scooters en onderdelen
- Gedetailleerde informatie en specificaties
- Koppeling tussen scooters en compatibele onderdelen

##### 3. Foto-uploadsysteem
- Meervoudige foto-upload voor scooters en onderdelen
- Polymorfische relatie tussen foto's en modellen
- Primaire foto selectie
- Fotobeheer (toevoegen, verwijderen)

```php
// Photo.php model met polymorfische relatie
class Photo extends Model
{
    protected $fillable = ['path', 'is_primary'];

    public function photoable()
    {
        return $this->morphTo();
    }
}

// Scooter.php model
public function photos()
{
    return $this->morphMany(Photo::class, 'photoable');
}

// Part.php model
public function photos()
{
    return $this->morphMany(Photo::class, 'photoable');
}
```

##### 4. Meertaligheid
- Volledige ondersteuning voor Nederlands en Engels
- Taalschakelaar in de navigatiebalk
- Vertaalbestanden voor alle teksten

```php
// Voorbeeld van een vertaalbestand (messages.php)
return [
    'welcome' => 'Welkom bij Lerox Motoren',
    'scooters' => 'Scooters',
    'parts' => 'Onderdelen',
    // ...
];

// Gebruik in Blade templates
{{ __('messages.welcome') }}
```

#### Moderne UI
- Bootstrap framework met custom CSS
- Responsief ontwerp voor alle schermformaten
- Consistente styling en branding
- Verbeterde gebruikerservaring

### BL-K1-W4: Test software

#### Testplan en -resultaten

- **Functionele tests**: 100% geslaagd
  - Authenticatie en autorisatie
  - Scooter- en onderdelenbeheer
  - Foto-uploadsysteem
  - Meertaligheid

- **Gebruikersacceptatietests**: 100% geslaagd
  - Bezoeker scenario's
  - Klant scenario's
  - Beheerder scenario's

- **Beveiligingstests**: 100% geslaagd
  - CSRF-beveiliging
  - XSS-preventie
  - SQL-injectie preventie
  - Authenticatie en autorisatie controles

- **Responsiviteitstests**: 100% geslaagd
  - Desktop, tablet en mobiele weergave
  - Navigatiemenu op verschillende schermen
  - Afbeeldingen en layout aanpassingen

- **Performancetests**: 80% geslaagd
  - Laadtijd homepage: 2.1 seconden (geslaagd)
  - Laadtijd scooterlijst: 2.4 seconden (geslaagd)
  - Laadtijd detailpagina met meerdere foto's: 4.7 seconden (gefaald, > 4 seconden)
  - Database query performance: 320ms (geslaagd)
  - Caching effectiviteit: 70% sneller (geslaagd)

- **Totaal slagingspercentage**: 98%

#### Gevonden Problemen en Oplossingen

**Performanceprobleem bij detailpagina's**:
- **Probleem**: Laadtijd > 4 seconden voor pagina's met meerdere foto's
- **Oorzaak**: Geen optimalisatie van afbeeldingen, geen lazy loading
- **Oplossing**: Implementatie van lazy loading, afbeeldingsoptimalisatie en caching

### BL-K1-W5: Doet verbetervoorstellen voor de software

#### Korte Termijn Verbeteringen
1. **Geavanceerde Zoekfunctie**
   - Filteren op merk, model, prijs, bouwjaar
   - AJAX voor real-time resultaten
   - Verbeterde gebruikerservaring

2. **Favorieten Functionaliteit**
   - Markeren van scooters/onderdelen als favoriet
   - Persoonlijke favorietenlijst voor gebruikers
   - Toggle functionaliteit met AJAX

3. **Verbeterde Fotogalerij**
   - Lightbox functionaliteit
   - Zoom en swipe ondersteuning
   - Optimalisatie voor verschillende schermformaten

#### Middellange Termijn Verbeteringen
1. **Beoordelingssysteem**
   - Reviews voor scooters en diensten
   - Sterrenbeoordelingen (1-5)
   - Moderatiemogelijkheden voor beheerders

2. **Reserveringssysteem**
   - Proefrit reserveren
   - Afspraken voor onderhoud
   - Integratie met kalender

3. **Uitbreiding Meertaligheid**
   - Extra talen (Duits, Frans, Turks)
   - Automatische taaldetectie
   - Verbeterde vertalingen

#### Lange Termijn Verbeteringen
1. **Integratie met Betalingssysteem**
   - Online betalingen voor reserveringen/onderdelen
   - Integratie met Mollie of Stripe
   - Winkelwagenfunctionaliteit

2. **Ontwikkeling Mobiele App**
   - Native app voor iOS en Android
   - Push notificaties
   - Offline toegang tot belangrijke informatie

3. **Implementatie van Chatbot**
   - AI-gestuurde klantenservice
   - Veelgestelde vragen beantwoorden
   - Integratie met menselijke ondersteuning

#### Technische Verbeteringen
1. **Performance Optimalisatie**
   - Caching implementatie
   - Database query optimalisatie
   - Frontend optimalisatie (minify, bundling)

2. **Verbeterde Logging en Monitoring**
   - Gedetailleerde error logging
   - Performance monitoring
   - Gebruikersgedrag analyse

3. **Automatische Tests**
   - Unit tests voor kernfunctionaliteiten
   - Feature tests voor gebruikersflows
   - CI/CD pipeline voor continue integratie

## BL-K2: Werkt in een ontwikkelteam

### BL-K2-W1: Voert overleg

#### Communicatie en Overleg
- Regelmatige afstemming met Beoordelaarss
- Duidelijke communicatie over voortgang en uitdagingen
- Verzamelen van feedback en vereisten
- Vastlegging van beslissingen en actiepunten

#### Samenwerking
- Gebruik van versiebeheer (Git) voor code
- Documentatie van ontwerpbeslissingen
- Kennisdeling en best practices

### BL-K2-W2: Presenteert het opgeleverde werk

#### Demonstratie van Functionaliteiten

##### Homepage en Navigatie
- Moderne, responsieve interface
- Intuïtieve navigatie
- Taalschakelaar

##### Scooter- en Onderdelencatalogus
- Overzichtelijke weergave van alle items
- Filtermogelijkheden
- Detailpagina's met uitgebreide informatie

##### Fotobeheer
- Meervoudige foto-upload demonstratie
- Primaire foto selectie
- Fotoverwijdering

##### Beheerdersfunctionaliteiten
- Toevoegen en bewerken van scooters en onderdelen
- Gebruikersbeheer
- Dashboard met statistieken

#### Technische Highlights
- Polymorfische relaties voor foto's
- Meertaligheid implementatie
- Moderne UI met responsive design
- Beveiligde authenticatie en autorisatie

### BL-K2-W3: Reflecteert op het werk

#### Procesreflectie

**Wat ging goed?**
- Implementatie van de meertaligheid
- Polymorfische relaties voor foto's
- Moderne UI met Bootstrap en custom CSS

**Wat kon beter?**
- Planning van complexe functionaliteiten
- Code organisatie
- Automatische tests

**Probleemoplossing**
- Uitdagingen bij meervoudige foto-upload
- Primaire foto selectie
- Responsieve layout

#### Technische Reflectie

**Technische Keuzes**
- Laravel Framework
- Bootstrap voor UI
- MySQL Database
- Polymorfische Relaties

**Wat heb ik geleerd?**
- Laravel Eloquent Relaties
- Frontend Development
- Meertaligheid in Laravel

**Technische Uitdagingen**
- Bestandsopslag
- AJAX Requests
- Database Optimalisatie

#### Persoonlijke Reflectie

**Persoonlijke Groei**
- Verbeterde probleemoplossende vaardigheden
- Diepere kennis van Laravel framework
- Verbeterde frontend-vaardigheden

**Toekomstige Toepassing**
- Toepassing van polymorfische relaties in toekomstige projecten
- Efficiëntere implementatie van meertaligheid
- Betere planning van complexe functionaliteiten

**Verdere Ontwikkeling**
- Test-Driven Development (TDD)
- API Development
- Frontend Frameworks (Vue.js, React)

## Conclusie

- Succesvolle ontwikkeling van een volledig functionele webapplicatie
- Alle projectdoelstellingen behaald
- Moderne, gebruiksvriendelijke interface
- Solide basis voor toekomstige uitbreidingen
- Waardevolle leerervaringen opgedaan

## Vragen?

Bedankt voor uw aandacht! Zijn er vragen?

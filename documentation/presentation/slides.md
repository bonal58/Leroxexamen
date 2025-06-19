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
  1. Analyse & requirements
  2. Ontwerp (database, UI)
  3. Implementatie
  4. Testen & documentatie

### Voortgangsbewaking
- Dagelijkse voortgangscontrole
- Prioritering van kernelementen
- Bijhouden van openstaande taken

---

## BL-K1-W2: Ontwerpt software

### Database Ontwerp
- Relationeel model met MySQL
- Polymorfische relaties voor foto's
- Efficiënte indexering voor snelle zoekopdrachten

### Diagrammen
- Entity Relationship Diagram (ERD)
- Klassendiagram met alle modellen en relaties
- Use Case Diagram voor gebruikersinteracties
- Sequence Diagram voor foto-upload proces

---

## BL-K1-W3: Realiseert (onderdelen van) software

### Technische Stack
- **Backend**: Laravel 10.x, PHP 8.1
- **Database**: MySQL 8.0
- **Frontend**: Blade templates, Bootstrap 5, JavaScript

### Kernfunctionaliteiten
1. Gebruikersbeheer & rolgebaseerde autorisatie
2. Scooter- en onderdelenbeheer (CRUD)
3. Meervoudig foto-uploadsysteem met polymorfische relaties
4. Meertaligheid (Nederlands/Engels)

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

### Testresultaten
- **Functionele tests**: 100% geslaagd
- **Gebruikersacceptatietests**: 100% geslaagd
- **Beveiligingstests**: 100% geslaagd
- **Responsiviteitstests**: 100% geslaagd
- **Performancetests**: 80% geslaagd
- **Totaal**: 98% geslaagd

### Gevonden Probleem & Oplossing
- Probleem: Laadtijd detailpagina's met meerdere foto's: 4.7s (> 4s)
- Oplossing: Lazy loading, afbeeldingsoptimalisatie, caching

---

## BL-K1-W5: Doet verbetervoorstellen voor de software

### Korte Termijn Verbeteringen
- Geavanceerde zoekfunctie met filters
- Favorieten functionaliteit voor gebruikers
- Verbeterde fotogalerij met zoom en carousel

### Middellange Termijn Verbeteringen
- Beoordelingssysteem voor scooters
- Reserveringssysteem voor proefritten
- Uitbreiding meertaligheid (Duits, Frans)

### Lange Termijn Verbeteringen
- Betalingssysteem integratie (Mollie, Stripe)
- Mobiele app ontwikkeling (iOS/Android)
- Chatbot implementatie voor klantenservice

---

# BL-K2: Werkt in een ontwikkelteam

---

## BL-K2-W1: Voert overleg

### Communicatie
- Regelmatige afstemming met Beoordelaars
- Duidelijke communicatie over voortgang en uitdagingen
- Verzamelen van feedback en verwerking hiervan

### Samenwerking
- Versiebeheer met Git en GitHub
- Uitgebreide documentatie van ontwerpbeslissingen
- Kennisdeling en toepassing van best practices

---

## BL-K2-W2: Presenteert het opgeleverde werk

### Demonstratie
- Homepage en navigatiestructuur
- Scooter- en onderdelencatalogus met filteropties
- Meervoudig fotobeheer met primaire foto selectie
- Beheerdersfunctionaliteiten en dashboard

### Technische Highlights
- Polymorfische relaties voor foto's
  - Eén foto-model voor meerdere entiteiten (Scooters, Onderdelen)
  - Efficiënt databaseontwerp zonder duplicatie
  - Herbruikbare code voor upload en beheer
- Beveiligde authenticatie en autorisatie
- Responsief ontwerp voor alle apparaten

---

## BL-K2-W3: Reflecteert op het werk

### Wat ging goed?
- Implementatie meertaligheid met Laravel's taalfuncties
- Polymorfische relaties voor foto's met efficiënte database-opslag
- Moderne UI met Bootstrap en custom CSS
- Gestructureerde projectaanpak en documentatie

### Wat kon beter?
- Planning van complexe functionaliteiten zoals foto-upload
- Code organisatie en herbruikbaarheid van componenten
- Automatische tests voor kritieke functionaliteit
- Performanceoptimalisatie voor afbeeldingen

### Leerpunten
- Laravel Eloquent relaties en polymorfische verbindingen
- Frontend development met responsive design
- Efficiënt projectmanagement en documentatie
- Testgedreven ontwikkeling

---

# Conclusie

- Succesvolle ontwikkeling van functionele webapplicatie
- Alle projectdoelstellingen behaald binnen de gestelde termijn
- Moderne, gebruiksvriendelijke interface met meertalige ondersteuning
- Solide basis voor toekomstige uitbreidingen en verbeteringen

---

# Vragen?

Bedankt voor uw aandacht!

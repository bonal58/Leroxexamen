# Lerox Motoren
## Examenopdracht Presentatie
Berkay Onal | 18 juni 2025

---

# BL-K1: Realiseert software

---

## BL-K1-W1: Plant werkzaamheden en bewaakt de voortgang

### Project Overzicht
- **Project**: Lerox Motoren webapplicatie
- **Periode**: 23 mei - 31 mei 2025
- **Doel**: Moderne website voor scooterverkoop met fotobeheer

### Planning & Methodiek
- Incrementele ontwikkeling
- Duidelijke fasering:
  1. Analyse & requirements
  2. Ontwerp (database, UI)
  3. Implementatie
  4. Testen & documentatie

### Voortgangsbewaking
- Dagelijkse voortgangscontrole
- Prioritering van kernelementen

---

## BL-K1-W2: Ontwerpt software

### Database Ontwerp
![Database Ontwerp](../diagrams/entity_relationship_diagram.md)
- Relationeel model met MySQL
- Polymorfische relaties voor foto's

### Diagrammen
- Entity Relationship Diagram
- Klassendiagram
- Use Case Diagram
- Sequence Diagram voor foto-upload

---

## BL-K1-W3: Realiseert (onderdelen van) software

### Technische Stack
- **Backend**: Laravel 10.x, PHP 8.1
- **Database**: MySQL
- **Frontend**: Blade, Bootstrap, JavaScript

### Kernfunctionaliteiten
1. Gebruikersbeheer & autorisatie
2. Scooter- en onderdelenbeheer (CRUD)
3. Meervoudig foto-uploadsysteem
4. Meertaligheid (NL/EN)

---

### Polymorfische Foto-relatie

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

### Moderne UI
- Bootstrap met custom CSS
- Responsief ontwerp
- Consistente styling en branding

---

## BL-K1-W4: Test software

### Testresultaten
- **Functionele tests**: 100% geslaagd
- **Gebruikersacceptatietests**: 100% geslaagd
- **Beveiligingstests**: 100% geslaagd
- **Responsiviteitstests**: 100% geslaagd
- **Performancetests**: 80% geslaagd
- **Totaal**: 98% geslaagd

### Gevonden Probleem
- Laadtijd detailpagina's met meerdere foto's: 4.7s (> 4s)
- Oplossing: Lazy loading, afbeeldingsoptimalisatie, caching

---

## BL-K1-W5: Doet verbetervoorstellen voor de software

### Korte Termijn
- Geavanceerde zoekfunctie
- Favorieten functionaliteit
- Verbeterde fotogalerij

### Middellange Termijn
- Beoordelingssysteem
- Reserveringssysteem
- Uitbreiding meertaligheid

### Lange Termijn
- Betalingssysteem integratie
- Mobiele app ontwikkeling
- Chatbot implementatie

---

# BL-K2: Werkt in een ontwikkelteam

---

## BL-K2-W1: Voert overleg

### Communicatie
- Regelmatige afstemming met Beoordelaarss
- Duidelijke communicatie over voortgang
- Verzamelen van feedback

### Samenwerking
- Versiebeheer met Git
- Documentatie van ontwerpbeslissingen
- Kennisdeling en best practices

---

## BL-K2-W2: Presenteert het opgeleverde werk

### Demonstratie
- Homepage en navigatie
- Scooter- en onderdelencatalogus
- Meervoudig fotobeheer
- Beheerdersfunctionaliteiten

### Technische Highlights
- Polymorfische relaties
- Meertaligheid implementatie
- Moderne, responsieve UI
- Beveiligde authenticatie

---

## BL-K2-W3: Reflecteert op het werk

### Wat ging goed?
- Implementatie meertaligheid
- Polymorfische relaties voor foto's
- Moderne UI met Bootstrap en custom CSS

### Wat kon beter?
- Planning van complexe functionaliteiten
- Code organisatie
- Automatische tests

### Leerpunten
- Laravel Eloquent relaties
- Frontend development
- Efficiënt projectmanagement

---

# Conclusie

- Succesvolle ontwikkeling van functionele webapplicatie
- Alle projectdoelstellingen behaald
- Moderne, gebruiksvriendelijke interface
- Solide basis voor toekomstige uitbreidingen

---

# Vragen?

Bedankt voor uw aandacht!

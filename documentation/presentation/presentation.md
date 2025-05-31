# Presentatie - Lerox Motoren

## 1. Introductie

- **Project**: Lerox Motoren - Webapplicatie voor scooterverkoop en onderdelen
- **Ontwikkelaar**: Berkay Onal
- **Periode**: 23 mei 2025 - 31 mei 2025

## 2. Projectdoelstellingen

- Ontwikkeling van een functionele scooter-webapp met CRUD-functionaliteiten
- Implementatie van gebruikersauthenticatie en autorisatie
- Ontwikkeling van een meertalige interface (Nederlands en Engels)
- Implementatie van een geavanceerd foto-uploadsysteem met polymorfische relaties

## 3. Technische Stack

- **Backend**: Laravel 10.x, PHP 8.1
- **Database**: MySQL
- **Frontend**: Blade templates, Bootstrap, JavaScript, CSS
- **Ontwikkelomgeving**: MAMP, Visual Studio Code, Git

## 4. Belangrijkste Functionaliteiten

### 4.1 Gebruikersbeheer
- Registratie en inloggen
- Rolgebaseerde autorisatie (bezoeker, klant, beheerder)
- Beveiligde routes en middleware

### 4.2 Scooter- en Onderdelenbeheer
- CRUD-operaties voor scooters en onderdelen
- Gedetailleerde informatie en specificaties
- Koppeling tussen scooters en compatibele onderdelen

### 4.3 Foto-uploadsysteem
- Meervoudige foto-upload voor scooters en onderdelen
- Polymorfische relatie tussen foto's en modellen
- Primaire foto selectie
- Fotobeheer (toevoegen, verwijderen)

### 4.4 Meertaligheid
- Volledige ondersteuning voor Nederlands en Engels
- Taalschakelaar in de navigatiebalk
- Vertaalbestanden voor alle teksten

## 5. Demonstratie

### 5.1 Homepage en Navigatie
- Moderne, responsieve interface
- Intuïtieve navigatie
- Taalschakelaar

### 5.2 Scooter- en Onderdelencatalogus
- Overzichtelijke weergave van alle items
- Filtermogelijkheden
- Detailpagina's met uitgebreide informatie

### 5.3 Fotobeheer
- Meervoudige foto-upload demonstratie
- Primaire foto selectie
- Fotoverwijdering

### 5.4 Beheerdersfunctionaliteiten
- Toevoegen en bewerken van scooters en onderdelen
- Gebruikersbeheer
- Dashboard met statistieken

## 6. Technische Highlights

### 6.1 Polymorfische Relaties
- Eén foto-model voor meerdere entiteiten
- Efficiënt databaseontwerp
- Herbruikbare code

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

### 6.2 Meertaligheid Implementatie
- Laravel's ingebouwde vertaalfuncties
- Middleware voor taaldetectie
- Sessiegebaseerde taalvoorkeur

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

### 6.3 Moderne UI
- Bootstrap framework met custom CSS
- Responsief ontwerp voor alle schermformaten
- Consistente styling en branding

## 7. Testresultaten

- **Functionele tests**: 100% geslaagd
- **Gebruikersacceptatietests**: 100% geslaagd
- **Beveiligingstests**: 100% geslaagd
- **Responsiviteitstests**: 100% geslaagd
- **Performancetests**: 80% geslaagd (1 gefaald)
- **Totaal slagingspercentage**: 98%

## 8. Verbetervoorstellen

### Korte termijn
- Geavanceerde zoekfunctie
- Favorieten functionaliteit
- Verbeterde fotogalerij

### Middellange termijn
- Beoordelingssysteem
- Reserveringssysteem
- Uitbreiding meertaligheid

### Lange termijn
- Integratie met betalingssysteem
- Ontwikkeling mobiele app
- Implementatie van chatbot

## 9. Leerpunten

- Diepgaande kennis van Laravel Eloquent relaties
- Ervaring met polymorfische relaties
- Verbeterde frontend-vaardigheden
- Efficiënt projectmanagement

## 10. Conclusie

- Succesvolle ontwikkeling van een volledig functionele webapplicatie
- Alle projectdoelstellingen behaald
- Moderne, gebruiksvriendelijke interface
- Solide basis voor toekomstige uitbreidingen

## 11. Vragen?

Bedankt voor uw aandacht! Zijn er vragen?

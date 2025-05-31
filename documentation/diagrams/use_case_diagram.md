# Use Case Diagram - Lerox Motoren

## Actoren
- **Bezoeker**: Niet-geregistreerde gebruiker die de website bezoekt
- **Klant**: Geregistreerde gebruiker die kan inloggen
- **Beheerder**: Administrator met volledige toegangsrechten

## Use Cases

### Bezoeker
- Website bekijken
- Scooters bekijken
- Onderdelen bekijken
- Diensten bekijken
- Contact informatie bekijken
- Registreren
- Inloggen

### Klant (erft van Bezoeker)
- Profiel bekijken
- Persoonlijke gegevens wijzigen
- Wachtwoord wijzigen
- Uitloggen

### Beheerder (erft van Klant)
- Scooters beheren (CRUD)
- Onderdelen beheren (CRUD)
- Diensten beheren (CRUD)
- Foto's beheren (uploaden, verwijderen, primaire foto instellen)
- Gebruikers beheren

## Relaties
- Bezoeker -> Klant (extends)
- Klant -> Beheerder (extends)

## Diagram Beschrijving

Het Use Case diagram voor Lerox Motoren toont de verschillende gebruikersrollen en hun interacties met het systeem. De website heeft drie hoofdrollen: Bezoeker, Klant en Beheerder, waarbij elke rol meer rechten heeft dan de vorige.

Bezoekers kunnen de website bekijken zonder in te loggen, inclusief het bekijken van scooters, onderdelen en diensten. Ze kunnen ook contact informatie bekijken en zich registreren of inloggen.

Klanten zijn geregistreerde gebruikers die kunnen inloggen. Ze hebben alle rechten van een Bezoeker, plus de mogelijkheid om hun profiel te bekijken en te beheren.

Beheerders hebben alle rechten van een Klant, plus uitgebreide beheermogelijkheden. Ze kunnen scooters, onderdelen en diensten toevoegen, wijzigen en verwijderen (CRUD-operaties). Ze kunnen ook foto's beheren, inclusief het uploaden van meerdere foto's, het verwijderen van foto's en het instellen van een primaire foto. Daarnaast kunnen ze gebruikers beheren.

Dit diagram laat duidelijk zien hoe de verschillende gebruikersrollen interacteren met het systeem en welke functionaliteiten beschikbaar zijn voor elke rol.

## Implementatie Notities

In de Laravel applicatie zijn deze use cases geïmplementeerd via:
- Controllers die de verschillende CRUD-operaties afhandelen
- Middleware voor authenticatie en autorisatie
- Blade templates voor de gebruikersinterface
- Polymorfische relaties voor het beheren van foto's voor verschillende entiteiten

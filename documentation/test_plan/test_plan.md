# Testplan - Lerox Motoren

## 1. Inleiding

Dit testplan beschrijft de teststrategie voor de Lerox Motoren website. Het doel is om te verzekeren dat alle functionaliteiten correct werken, de gebruikerservaring optimaal is, en dat de website voldoet aan de gestelde eisen.

### 1.1 Doel van het testen

- Valideren dat alle functionaliteiten correct werken
- Controleren of de website voldoet aan de gebruikersvereisten
- Identificeren van eventuele bugs of problemen
- Verzekeren dat de website veilig is
- Controleren of de website goed werkt op verschillende apparaten en browsers

### 1.2 Scope

Dit testplan omvat:
- Functionele tests
- Gebruikersacceptatietests
- Beveiligingstests
- Responsiviteitstests
- Performancetests

## 2. Functionele Tests

### 2.1 Authenticatie en Autorisatie

| Test ID | Beschrijving | Verwacht Resultaat | Status |
|---------|-------------|-------------------|--------|
| AUTH-01 | Registratie met geldige gegevens | Gebruiker wordt geregistreerd en ingelogd | - |
| AUTH-02 | Inloggen met geldige gegevens | Gebruiker wordt ingelogd en doorgestuurd naar dashboard | - |
| AUTH-03 | Inloggen met ongeldige gegevens | Foutmelding wordt getoond | - |
| AUTH-04 | Uitloggen | Gebruiker wordt uitgelogd en doorgestuurd naar homepage | - |
| AUTH-05 | Toegang tot beheerdersfuncties als normale gebruiker | Toegang wordt geweigerd | - |

### 2.2 Scooter Management

| Test ID | Beschrijving | Verwacht Resultaat | Status |
|---------|-------------|-------------------|--------|
| SCO-01 | Scooter toevoegen met geldige gegevens | Scooter wordt toegevoegd aan database | - |
| SCO-02 | Scooter bewerken | Scootergegevens worden bijgewerkt | - |
| SCO-03 | Scooter verwijderen | Scooter wordt verwijderd uit database | - |
| SCO-04 | Scooterlijst bekijken | Alle scooters worden getoond | - |
| SCO-05 | Scooterdetails bekijken | Details van geselecteerde scooter worden getoond | - |

### 2.3 Onderdelen Management

| Test ID | Beschrijving | Verwacht Resultaat | Status |
|---------|-------------|-------------------|--------|
| PRT-01 | Onderdeel toevoegen met geldige gegevens | Onderdeel wordt toegevoegd aan database | - |
| PRT-02 | Onderdeel bewerken | Onderdeelgegevens worden bijgewerkt | - |
| PRT-03 | Onderdeel verwijderen | Onderdeel wordt verwijderd uit database | - |
| PRT-04 | Onderdelenlijst bekijken | Alle onderdelen worden getoond | - |
| PRT-05 | Onderdeeldetails bekijken | Details van geselecteerd onderdeel worden getoond | - |

### 2.4 Foto Management

| Test ID | Beschrijving | Verwacht Resultaat | Status |
|---------|-------------|-------------------|--------|
| PHO-01 | Enkele foto uploaden voor scooter | Foto wordt opgeslagen en gekoppeld aan scooter | - |
| PHO-02 | Meerdere foto's uploaden voor scooter | Alle foto's worden opgeslagen en gekoppeld aan scooter | - |
| PHO-03 | Primaire foto instellen voor scooter | Geselecteerde foto wordt als primair gemarkeerd | - |
| PHO-04 | Foto verwijderen | Foto wordt verwijderd van server en database | - |
| PHO-05 | Foto's bekijken in detailweergave | Alle foto's van het item worden getoond | - |

### 2.5 Meertaligheid

| Test ID | Beschrijving | Verwacht Resultaat | Status |
|---------|-------------|-------------------|--------|
| LNG-01 | Schakelen tussen Nederlands en Engels | Taal wordt gewijzigd en alle teksten worden vertaald | - |
| LNG-02 | Controleren van vertalingen op homepage | Alle teksten zijn correct vertaald | - |
| LNG-03 | Controleren van vertalingen in formulieren | Alle labels en placeholders zijn correct vertaald | - |
| LNG-04 | Controleren van vertalingen in foutmeldingen | Alle foutmeldingen zijn correct vertaald | - |
| LNG-05 | Taalvoorkeur wordt onthouden | Bij volgend bezoek wordt laatst gekozen taal gebruikt | - |

## 3. Gebruikersacceptatietests (UAT)

### 3.1 Bezoeker Scenario's

| Test ID | Scenario | Acceptatiecriteria | Status |
|---------|---------|-------------------|--------|
| UAT-01 | Als bezoeker wil ik de homepage bekijken | Homepage toont relevante informatie over Lerox Motoren | - |
| UAT-02 | Als bezoeker wil ik beschikbare scooters bekijken | Scooterlijst toont alle beschikbare scooters met basisinformatie | - |
| UAT-03 | Als bezoeker wil ik details van een scooter bekijken | Detailpagina toont alle informatie en foto's van de scooter | - |
| UAT-04 | Als bezoeker wil ik onderdelen bekijken | Onderdelenlijst toont alle beschikbare onderdelen | - |
| UAT-05 | Als bezoeker wil ik contactinformatie vinden | Contactpagina toont adres, telefoonnummer en e-mail | - |

### 3.2 Klant Scenario's

| Test ID | Scenario | Acceptatiecriteria | Status |
|---------|---------|-------------------|--------|
| UAT-06 | Als klant wil ik mijn profiel bekijken | Profielpagina toont persoonlijke gegevens | - |
| UAT-07 | Als klant wil ik mijn wachtwoord wijzigen | Wachtwoord wordt gewijzigd en beveiligd opgeslagen | - |
| UAT-08 | Als klant wil ik uitloggen | Sessie wordt beëindigd en gebruiker wordt uitgelogd | - |

### 3.3 Beheerder Scenario's

| Test ID | Scenario | Acceptatiecriteria | Status |
|---------|---------|-------------------|--------|
| UAT-09 | Als beheerder wil ik een nieuwe scooter toevoegen | Scooter wordt toegevoegd met alle gegevens en foto's | - |
| UAT-10 | Als beheerder wil ik meerdere foto's uploaden | Alle foto's worden correct opgeslagen en weergegeven | - |
| UAT-11 | Als beheerder wil ik een primaire foto instellen | De geselecteerde foto wordt als eerste getoond | - |
| UAT-12 | Als beheerder wil ik gebruikers beheren | Gebruikerslijst toont alle gebruikers met beheeropties | - |

## 4. Beveiligingstests

| Test ID | Beschrijving | Verwacht Resultaat | Status |
|---------|-------------|-------------------|--------|
| SEC-01 | CSRF-beveiliging | CSRF-tokens worden gecontroleerd bij formuliersubmissies | - |
| SEC-02 | XSS-preventie | Gebruikersinvoer wordt correct geëscaped | - |
| SEC-03 | SQL-injectie preventie | Queries zijn beveiligd tegen injectie | - |
| SEC-04 | Authenticatie bypass | Beveiligde routes zijn niet toegankelijk zonder authenticatie | - |
| SEC-05 | Autorisatie bypass | Beheerdersfuncties zijn niet toegankelijk voor normale gebruikers | - |

## 5. Responsiviteitstests

| Test ID | Beschrijving | Verwacht Resultaat | Status |
|---------|-------------|-------------------|--------|
| RES-01 | Desktop weergave (1920x1080) | Website wordt correct weergegeven | - |
| RES-02 | Tablet weergave (768x1024) | Website schaalt correct en is bruikbaar | - |
| RES-03 | Mobiele weergave (375x667) | Website schaalt correct en is bruikbaar | - |
| RES-04 | Navigatiemenu op mobiel | Menu klapt uit/in en is bruikbaar | - |
| RES-05 | Afbeeldingen op verschillende schermen | Afbeeldingen schalen correct | - |

## 6. Performancetests

| Test ID | Beschrijving | Verwacht Resultaat | Status |
|---------|-------------|-------------------|--------|
| PER-01 | Laadtijd homepage | < 3 seconden | - |
| PER-02 | Laadtijd scooterlijst | < 3 seconden | - |
| PER-03 | Laadtijd detailpagina met meerdere foto's | < 4 seconden | - |
| PER-04 | Database query performance | Queries nemen < 500ms in beslag | - |
| PER-05 | Caching effectiviteit | Herhaalde requests zijn significant sneller | - |

## 7. Testomgeving

### 7.1 Hardware
- Server: MAMP lokale ontwikkelomgeving
- Client: Verschillende apparaten voor responsiviteitstests

### 7.2 Software
- Besturingssysteem: macOS
- Webserver: Apache
- Database: MySQL
- PHP versie: 8.1
- Laravel versie: 10.x
- Browsers: Chrome, Firefox, Safari, Edge

## 8. Testuitvoering

### 8.1 Testprocedure
1. Voer functionele tests uit volgens de testscenario's
2. Documenteer resultaten en eventuele bugs
3. Voer regressietests uit na het oplossen van bugs
4. Voer gebruikersacceptatietests uit
5. Voer beveiligings- en performancetests uit

### 8.2 Testrapportage
Na afloop van elke testfase wordt een testrapport opgesteld met:
- Uitgevoerde tests
- Resultaten (geslaagd/gefaald)
- Gevonden bugs
- Aanbevelingen voor verbetering

## 9. Conclusie

Dit testplan biedt een gestructureerde aanpak voor het testen van de Lerox Motoren website. Door het volgen van dit plan kunnen we verzekeren dat de website voldoet aan alle functionele en niet-functionele eisen, en dat de gebruikerservaring optimaal is.

De tests zijn ontworpen om alle aspecten van de website te dekken, van basisfunctionaliteit tot beveiliging en performance. Door deze tests uit te voeren, kunnen we potentiële problemen vroeg identificeren en oplossen, wat resulteert in een hoogwaardige, betrouwbare website.

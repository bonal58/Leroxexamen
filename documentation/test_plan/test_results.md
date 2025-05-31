# Testresultaten - Lerox Motoren

## 1. Inleiding

Dit document bevat de resultaten van de tests die zijn uitgevoerd op de Lerox Motoren website volgens het testplan. De tests zijn uitgevoerd op 31 mei 2025.

## 2. Samenvatting van Testresultaten

| Testcategorie | Aantal Tests | Geslaagd | Gefaald | Slagingspercentage |
|---------------|--------------|----------|---------|---------------------|
| Authenticatie en Autorisatie | 5 | 5 | 0 | 100% |
| Scooter Management | 5 | 5 | 0 | 100% |
| Onderdelen Management | 5 | 5 | 0 | 100% |
| Foto Management | 5 | 5 | 0 | 100% |
| Meertaligheid | 5 | 5 | 0 | 100% |
| Gebruikersacceptatietests | 12 | 12 | 0 | 100% |
| Beveiligingstests | 5 | 5 | 0 | 100% |
| Responsiviteitstests | 5 | 5 | 0 | 100% |
| Performancetests | 5 | 4 | 1 | 80% |
| **Totaal** | **52** | **51** | **1** | **98%** |

## 3. Gedetailleerde Testresultaten

### 3.1 Authenticatie en Autorisatie

| Test ID | Beschrijving | Status | Opmerkingen |
|---------|-------------|--------|-------------|
| AUTH-01 | Registratie met geldige gegevens | Geslaagd | Gebruiker wordt succesvol geregistreerd |
| AUTH-02 | Inloggen met geldige gegevens | Geslaagd | Gebruiker wordt ingelogd en naar dashboard gestuurd |
| AUTH-03 | Inloggen met ongeldige gegevens | Geslaagd | Correcte foutmelding wordt getoond |
| AUTH-04 | Uitloggen | Geslaagd | Gebruiker wordt uitgelogd en naar homepage gestuurd |
| AUTH-05 | Toegang tot beheerdersfuncties als normale gebruiker | Geslaagd | Toegang wordt correct geweigerd |

### 3.2 Scooter Management

| Test ID | Beschrijving | Status | Opmerkingen |
|---------|-------------|--------|-------------|
| SCO-01 | Scooter toevoegen met geldige gegevens | Geslaagd | Scooter wordt correct toegevoegd |
| SCO-02 | Scooter bewerken | Geslaagd | Wijzigingen worden correct opgeslagen |
| SCO-03 | Scooter verwijderen | Geslaagd | Scooter wordt correct verwijderd |
| SCO-04 | Scooterlijst bekijken | Geslaagd | Alle scooters worden correct weergegeven |
| SCO-05 | Scooterdetails bekijken | Geslaagd | Details worden correct weergegeven |

### 3.3 Onderdelen Management

| Test ID | Beschrijving | Status | Opmerkingen |
|---------|-------------|--------|-------------|
| PRT-01 | Onderdeel toevoegen met geldige gegevens | Geslaagd | Onderdeel wordt correct toegevoegd |
| PRT-02 | Onderdeel bewerken | Geslaagd | Wijzigingen worden correct opgeslagen |
| PRT-03 | Onderdeel verwijderen | Geslaagd | Onderdeel wordt correct verwijderd |
| PRT-04 | Onderdelenlijst bekijken | Geslaagd | Alle onderdelen worden correct weergegeven |
| PRT-05 | Onderdeeldetails bekijken | Geslaagd | Details worden correct weergegeven |

### 3.4 Foto Management

| Test ID | Beschrijving | Status | Opmerkingen |
|---------|-------------|--------|-------------|
| PHO-01 | Enkele foto uploaden voor scooter | Geslaagd | Foto wordt correct opgeslagen |
| PHO-02 | Meerdere foto's uploaden voor scooter | Geslaagd | Alle foto's worden correct opgeslagen |
| PHO-03 | Primaire foto instellen voor scooter | Geslaagd | Primaire foto wordt correct ingesteld |
| PHO-04 | Foto verwijderen | Geslaagd | Foto wordt correct verwijderd |
| PHO-05 | Foto's bekijken in detailweergave | Geslaagd | Alle foto's worden correct weergegeven |

### 3.5 Meertaligheid

| Test ID | Beschrijving | Status | Opmerkingen |
|---------|-------------|--------|-------------|
| LNG-01 | Schakelen tussen Nederlands en Engels | Geslaagd | Taal wordt correct gewijzigd |
| LNG-02 | Controleren van vertalingen op homepage | Geslaagd | Alle teksten zijn correct vertaald |
| LNG-03 | Controleren van vertalingen in formulieren | Geslaagd | Alle labels en placeholders zijn correct vertaald |
| LNG-04 | Controleren van vertalingen in foutmeldingen | Geslaagd | Alle foutmeldingen zijn correct vertaald |
| LNG-05 | Taalvoorkeur wordt onthouden | Geslaagd | Laatst gekozen taal wordt correct onthouden |

### 3.6 Gebruikersacceptatietests (UAT)

| Test ID | Scenario | Status | Opmerkingen |
|---------|---------|--------|-------------|
| UAT-01 | Als bezoeker wil ik de homepage bekijken | Geslaagd | Homepage toont alle relevante informatie |
| UAT-02 | Als bezoeker wil ik beschikbare scooters bekijken | Geslaagd | Scooterlijst wordt correct weergegeven |
| UAT-03 | Als bezoeker wil ik details van een scooter bekijken | Geslaagd | Detailpagina toont alle informatie |
| UAT-04 | Als bezoeker wil ik onderdelen bekijken | Geslaagd | Onderdelenlijst wordt correct weergegeven |
| UAT-05 | Als bezoeker wil ik contactinformatie vinden | Geslaagd | Contactpagina toont alle informatie |
| UAT-06 | Als klant wil ik mijn profiel bekijken | Geslaagd | Profielpagina toont correcte gegevens |
| UAT-07 | Als klant wil ik mijn wachtwoord wijzigen | Geslaagd | Wachtwoord wordt correct gewijzigd |
| UAT-08 | Als klant wil ik uitloggen | Geslaagd | Gebruiker wordt correct uitgelogd |
| UAT-09 | Als beheerder wil ik een nieuwe scooter toevoegen | Geslaagd | Scooter wordt correct toegevoegd |
| UAT-10 | Als beheerder wil ik meerdere foto's uploaden | Geslaagd | Foto's worden correct geüpload |
| UAT-11 | Als beheerder wil ik een primaire foto instellen | Geslaagd | Primaire foto wordt correct ingesteld |
| UAT-12 | Als beheerder wil ik gebruikers beheren | Geslaagd | Gebruikersbeheer werkt correct |

### 3.7 Beveiligingstests

| Test ID | Beschrijving | Status | Opmerkingen |
|---------|-------------|--------|-------------|
| SEC-01 | CSRF-beveiliging | Geslaagd | CSRF-tokens worden correct gecontroleerd |
| SEC-02 | XSS-preventie | Geslaagd | Gebruikersinvoer wordt correct geëscaped |
| SEC-03 | SQL-injectie preventie | Geslaagd | Queries zijn beveiligd tegen injectie |
| SEC-04 | Authenticatie bypass | Geslaagd | Beveiligde routes zijn niet toegankelijk zonder authenticatie |
| SEC-05 | Autorisatie bypass | Geslaagd | Beheerdersfuncties zijn niet toegankelijk voor normale gebruikers |

### 3.8 Responsiviteitstests

| Test ID | Beschrijving | Status | Opmerkingen |
|---------|-------------|--------|-------------|
| RES-01 | Desktop weergave (1920x1080) | Geslaagd | Website wordt correct weergegeven |
| RES-02 | Tablet weergave (768x1024) | Geslaagd | Website schaalt correct |
| RES-03 | Mobiele weergave (375x667) | Geslaagd | Website schaalt correct |
| RES-04 | Navigatiemenu op mobiel | Geslaagd | Menu werkt correct op mobiel |
| RES-05 | Afbeeldingen op verschillende schermen | Geslaagd | Afbeeldingen schalen correct |

### 3.9 Performancetests

| Test ID | Beschrijving | Status | Opmerkingen |
|---------|-------------|--------|-------------|
| PER-01 | Laadtijd homepage | Geslaagd | Laadtijd: 2.1 seconden |
| PER-02 | Laadtijd scooterlijst | Geslaagd | Laadtijd: 2.4 seconden |
| PER-03 | Laadtijd detailpagina met meerdere foto's | Gefaald | Laadtijd: 4.7 seconden (> 4 seconden) |
| PER-04 | Database query performance | Geslaagd | Gemiddelde query tijd: 320ms |
| PER-05 | Caching effectiviteit | Geslaagd | Herhaalde requests 70% sneller |

## 4. Gevonden Problemen en Oplossingen

### 4.1 Performanceprobleem bij detailpagina's

**Probleem**: De laadtijd van detailpagina's met meerdere foto's is hoger dan de gestelde eis van 4 seconden (gemeten: 4.7 seconden).

**Oorzaak**: De foto's worden niet geoptimaliseerd en er is geen lazy loading geïmplementeerd.

**Oplossing**: 
- Implementeer lazy loading voor foto's
- Optimaliseer foto's (compressie, juiste formaten)
- Implementeer caching voor detailpagina's

**Status**: Opgenomen in verbetervoorstellen, nog niet geïmplementeerd

## 5. Conclusie

De Lerox Motoren website heeft de tests grotendeels succesvol doorstaan, met een slagingspercentage van 98%. Slechts één test is gefaald, namelijk de performancetest voor detailpagina's met meerdere foto's. Dit probleem is geïdentificeerd en er zijn oplossingen voorgesteld in de verbetervoorstellen.

De website voldoet aan alle functionele eisen, is veilig, responsief en gebruiksvriendelijk. De meertaligheid werkt correct en de foto-functionaliteit met polymorfische relaties functioneert zoals verwacht.

### 5.1 Aanbevelingen

Op basis van de testresultaten worden de volgende aanbevelingen gedaan:

1. Implementeer de voorgestelde oplossingen voor het performanceprobleem bij detailpagina's
2. Voer regelmatig regressietests uit om te verzekeren dat nieuwe functionaliteiten geen invloed hebben op bestaande functionaliteit
3. Implementeer automatische tests om het testproces te versnellen en te verbeteren

---

*Testdatum: 31 mei 2025*  
*Tester: Berkay Onal*

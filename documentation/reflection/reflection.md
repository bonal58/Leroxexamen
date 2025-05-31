# Reflectie - Lerox Motoren Project

## 1. Procesreflectie

### 1.1 Aanpak en Planning

Bij de start van het Lerox Motoren project heb ik eerst een duidelijke planning opgesteld. Ik heb het project opgedeeld in verschillende fasen:

1. **Analysefase**: Bestuderen van de requirements en het maken van diagrammen
2. **Ontwerpfase**: Ontwerpen van de database en de gebruikersinterface
3. **Implementatiefase**: Ontwikkelen van de functionaliteiten
4. **Testfase**: Testen van de applicatie
5. **Documentatiefase**: Documenteren van het project

Voor elke fase heb ik specifieke doelen en deadlines gesteld. Dit heeft me geholpen om gestructureerd te werken en de voortgang te bewaken.

### 1.2 Wat ging goed?

**Implementatie van de meertaligheid**
De implementatie van de meertaligheid ging zeer goed. Door gebruik te maken van Laravel's ingebouwde vertaalfuncties kon ik eenvoudig alle teksten in zowel Nederlands als Engels aanbieden. Het gebruik van vertaalbestanden maakte het ook gemakkelijk om nieuwe teksten toe te voegen of bestaande teksten te wijzigen.

**Polymorfische relaties voor foto's**
De implementatie van de polymorfische relatie voor foto's was een uitdaging, maar is uiteindelijk zeer goed gelukt. Deze aanpak maakte het mogelijk om dezelfde foto-functionaliteit te gebruiken voor zowel scooters als onderdelen, wat de code DRY (Don't Repeat Yourself) houdt.

**Moderne UI met Bootstrap en custom CSS**
Het gebruik van Bootstrap in combinatie met custom CSS heeft geleid tot een moderne en responsieve gebruikersinterface. De toevoeging van custom CSS heeft ervoor gezorgd dat de website een unieke uitstraling heeft die past bij het Lerox Motoren merk.

### 1.3 Wat kon beter?

**Planning van complexe functionaliteiten**
De implementatie van de meervoudige foto-upload functionaliteit nam meer tijd in beslag dan gepland. In de toekomst zou ik meer tijd reserveren voor complexe functionaliteiten en deze verder opdelen in kleinere, beheersbare taken.

**Code organisatie**
Hoewel de code goed georganiseerd is, zou ik in de toekomst nog meer gebruik maken van services en repositories om de controllers slanker te maken en de business logic beter te scheiden van de presentatielaag.

**Automatische tests**
Ik heb niet zoveel automatische tests geschreven als ik had gewild. In een volgend project zou ik meer tijd besteden aan het schrijven van unit tests en feature tests om de kwaliteit van de code te waarborgen.

### 1.4 Probleemoplossing

Tijdens het project ben ik verschillende uitdagingen tegengekomen:

**Uitdaging 1: Meerdere foto's uploaden**
Bij het implementeren van de meervoudige foto-upload functionaliteit liep ik tegen het probleem aan dat de formulierverwerking complex werd. Ik heb dit opgelost door een combinatie van AJAX voor de upload en JavaScript voor de gebruikersinterface te gebruiken.

**Uitdaging 2: Primaire foto selecteren**
Het selecteren van een primaire foto was een uitdaging omdat dit zowel in de database als in de gebruikersinterface moest worden weergegeven. Ik heb dit opgelost door een `is_primary` veld toe te voegen aan het Photo model en een JavaScript functie te schrijven die de selectie van de primaire foto verwerkt.

**Uitdaging 3: Responsieve layout**
Het maken van een volledig responsieve layout was een uitdaging, vooral voor de fotogalerij. Ik heb dit opgelost door gebruik te maken van CSS Grid en Flexbox in combinatie met media queries.

## 2. Technische Reflectie

### 2.1 Technische Keuzes

**Laravel Framework**
De keuze voor Laravel als framework was een goede beslissing. Laravel biedt veel functionaliteiten out-of-the-box, zoals authenticatie, migraties en Eloquent ORM, wat de ontwikkeling heeft versneld.

**Bootstrap voor UI**
Bootstrap was een goede keuze voor de basis van de gebruikersinterface. Het biedt een solide grid-systeem en veel componenten die ik kon aanpassen met custom CSS.

**MySQL Database**
MySQL was een geschikte keuze voor de database. Het is betrouwbaar, goed gedocumenteerd en werkt naadloos samen met Laravel.

**Polymorfische Relaties**
De keuze voor polymorfische relaties voor de foto's was een goede beslissing. Het maakte de code herbruikbaar en makkelijk te onderhouden.

### 2.2 Wat heb ik geleerd?

**Laravel Eloquent Relaties**
Ik heb veel geleerd over de verschillende soorten relaties in Laravel Eloquent, vooral over polymorfische relaties. Dit heeft mijn begrip van database-ontwerp en ORM verbeterd.

**Frontend Development**
Ik heb mijn vaardigheden in frontend development verbeterd, vooral op het gebied van responsieve design en JavaScript. Ik heb geleerd hoe ik custom CSS kan gebruiken om een unieke look-and-feel te creëren.

**Meertaligheid in Laravel**
Ik heb geleerd hoe ik meertaligheid kan implementeren in Laravel en hoe ik vertaalbestanden kan gebruiken om de applicatie in verschillende talen aan te bieden.

### 2.3 Technische Uitdagingen

**Uitdaging 1: Bestandsopslag**
Het opslaan en beheren van bestanden (foto's) was een technische uitdaging. Ik heb geleerd hoe ik Laravel's Storage facade kan gebruiken om bestanden op te slaan en te beheren.

**Uitdaging 2: AJAX Requests**
Het implementeren van AJAX requests voor de foto-upload was een uitdaging. Ik heb geleerd hoe ik FormData kan gebruiken om bestanden te uploaden zonder de pagina te verversen.

**Uitdaging 3: Database Optimalisatie**
Het optimaliseren van database queries was een uitdaging, vooral bij het ophalen van scooters of onderdelen met hun bijbehorende foto's. Ik heb geleerd hoe ik eager loading kan gebruiken om het N+1 query probleem te voorkomen.

## 3. Persoonlijke Reflectie

### 3.1 Persoonlijke Groei

Dit project heeft me geholpen om te groeien als ontwikkelaar. Ik heb nieuwe technieken geleerd en bestaande vaardigheden verbeterd. Ik voel me nu zekerder in het werken met Laravel en het ontwikkelen van webapplicaties in het algemeen.

### 3.2 Toekomstige Toepassing

De kennis en vaardigheden die ik heb opgedaan tijdens dit project zal ik in de toekomst kunnen toepassen op andere projecten. Vooral de ervaring met polymorfische relaties, meertaligheid en frontend development zal waardevol zijn.

### 3.3 Verdere Ontwikkeling

In de toekomst wil ik me verder ontwikkelen op de volgende gebieden:

1. **Test-Driven Development (TDD)**: Ik wil meer ervaring opdoen met TDD om de kwaliteit van mijn code te verbeteren.
2. **API Development**: Ik wil leren hoe ik RESTful APIs kan ontwikkelen met Laravel.
3. **Frontend Frameworks**: Ik wil meer leren over moderne frontend frameworks zoals Vue.js of React.

## 4. Conclusie

Het Lerox Motoren project was een waardevolle leerervaring. Ik heb nieuwe technieken geleerd, bestaande vaardigheden verbeterd en ben gegroeid als ontwikkelaar. De uitdagingen die ik ben tegengekomen hebben me geholpen om mijn probleemoplossend vermogen te verbeteren.

Het eindresultaat is een moderne, gebruiksvriendelijke website die voldoet aan de eisen van de opdrachtgever. De website is meertalig, heeft een responsieve layout en biedt de mogelijkheid om meerdere foto's te uploaden en te beheren.

Ik ben tevreden met het resultaat, maar zie ook mogelijkheden voor verbetering. In de toekomst zou ik meer aandacht besteden aan automatische tests, code organisatie en performance optimalisatie.

---

*Datum: 31 mei 2025*  
*Naam: Berkay Onal*

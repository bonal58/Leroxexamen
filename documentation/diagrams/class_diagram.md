# Klassendiagram - Lerox Motoren

```mermaid
classDiagram
    class User {
        +id
        +name
        +email
        +role
        +isAdmin()
    }
    
    class Scooter {
        +id
        +name
        +brand
        +model
        +year
        +price
        +color
        +stock
        +photos()
        +getPrimaryPhoto()
    }
    
    class Part {
        +id
        +name
        +sku
        +price
        +stock
        +photos()
        +getPrimaryPhoto()
    }
    
    class Service {
        +id
        +name
        +price
        +duration
        +category
        +photos()
    }
    
    class Photo {
        +id
        +path
        +is_primary
        +photoable_id
        +photoable_type
        +photoable()
        +getUrl()
    }
    
    class Order {
        +id
        +user_id
        +total_amount
        +status
        +items()
    }
    
    class OrderItem {
        +id
        +order_id
        +orderable_type
        +orderable_id
        +quantity
        +price
        +orderable()
    }
    
    User "1" --> "*" Order: plaatst
    Order "1" --> "*" OrderItem: bevat
    Scooter "1" --> "*" Photo: heeft
    Part "1" --> "*" Photo: heeft
    Service "1" --> "*" Photo: heeft
    Scooter "*" <--> "*" Part: compatibel met
```

## Uitleg van de klassen

### User
De gebruiker van het systeem, kan een klant of admin zijn.
- **Belangrijke methoden**: `isAdmin()` controleert of een gebruiker beheerrechten heeft

### Scooter
Representeert een scooter in de webshop.
- **Belangrijke methoden**: `photos()` geeft alle foto's van de scooter, `getPrimaryPhoto()` geeft de hoofdfoto

### Part
Representeert een onderdeel dat verkocht wordt of compatibel is met scooters.
- **Belangrijke methoden**: `photos()` geeft alle foto's van het onderdeel

### Service
Representeert een dienst die aangeboden wordt in de webshop.
- **Belangrijke methoden**: `photos()` geeft alle foto's van de dienst

### Photo
Representeert een afbeelding die gekoppeld is aan een scooter, onderdeel of dienst.
- **Belangrijke methoden**: `photoable()` geeft het object waar de foto bij hoort, `getUrl()` geeft de URL van de afbeelding

## Wat is een polymorfische relatie?

In dit project worden polymorfische relaties gebruikt voor foto's en bestelitems. Dit betekent dat:

1. **Eén foto-klasse** kan gebruikt worden voor verschillende soorten producten (scooters, onderdelen, diensten)
2. **Eén bestelitem-klasse** kan verwijzen naar verschillende soorten producten

Dit werkt via twee speciale velden:
- `photoable_id`: Het ID van het product
- `photoable_type`: Het type product (bijv. "App\Models\Scooter")

### Voordelen
- Minder code herhaling
- Flexibeler systeem
- Eenvoudiger onderhoud

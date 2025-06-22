# Entity Relationship Diagram (ERD)

Dit diagram toont de belangrijkste entiteiten in de database en hun relaties.

```mermaid
erDiagram
    User ||--o{ Order : "plaatst"
    User {
        id PK
        name
        email
        role
    }
    
    Scooter ||--o{ Photo : "heeft"
    Scooter ||--o{ Order_Item : "in bestelling"
    Scooter }o--o{ Part : "compatibel met"
    Scooter {
        id PK
        name
        brand
        model
        year
        price
        color
        stock
    }
    
    Part ||--o{ Photo : "heeft"
    Part ||--o{ Order_Item : "in bestelling"
    Part {
        id PK
        name
        sku
        price
        stock
    }
    
    Service ||--o{ Photo : "heeft"
    Service ||--o{ Order_Item : "in bestelling"
    Service {
        id PK
        name
        price
        duration
        category
    }
    
    Order ||--o{ Order_Item : "bevat"
    Order {
        id PK
        user_id FK
        total_amount
        status
    }
    
    Order_Item {
        id PK
        order_id FK
        orderable_type
        orderable_id
        quantity
        price
    }
    
    Photo {
        id PK
        photoable_type
        photoable_id
        path
        is_primary
    }
```

## Uitleg van de relaties

- **User - Order**: Een gebruiker kan meerdere bestellingen plaatsen
- **Scooter - Photo**: Een scooter kan meerdere foto's hebben
- **Part - Photo**: Een onderdeel kan meerdere foto's hebben
- **Service - Photo**: Een dienst kan meerdere foto's hebben
- **Scooter - Part**: Scooters en onderdelen hebben een veel-op-veel relatie (compatibiliteit)
- **Order - Order_Item**: Een bestelling bevat meerdere bestelitems
- **Order_Item - (Scooter/Part/Service)**: Een bestelitem kan verwijzen naar een scooter, onderdeel of dienst

## Polymorfische relaties

- **Photo**: Heeft een polymorfische relatie met Scooter, Part en Service via `photoable_type` en `photoable_id`
- **Order_Item**: Heeft een polymorfische relatie met Scooter, Part en Service via `orderable_type` en `orderable_id`

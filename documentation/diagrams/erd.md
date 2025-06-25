# Entity Relationship Diagram (ERD)

Dit diagram toont de belangrijkste entiteiten in de database en hun relaties.

```mermaid
erDiagram
    User ||--o{ Order : plaatst
    User {
        int id PK
        string name
        string email
        string role
    }
    
    Scooter ||--o{ Photo : heeft
    Scooter ||--o{ Order_Item : "in bestelling"
    Scooter }o--o{ Part : "compatibel met"
    Scooter {
        int id PK
        string name
        string brand
        string model
        int year
        decimal price
        string color
        int stock
    }
    
    Part ||--o{ Photo : heeft
    Part ||--o{ Order_Item : "in bestelling"
    Part {
        int id PK
        string name
        string sku
        decimal price
        int stock
    }
    
    Service ||--o{ Photo : heeft
    Service ||--o{ Order_Item : "in bestelling"
    Service {
        int id PK
        string name
        decimal price
        int duration
        string category
    }
    
    Order ||--o{ Order_Item : bevat
    Order {
        int id PK
        int user_id FK
        decimal total_amount
        string status
    }
    
    Order_Item {
        int id PK
        int order_id FK
        string orderable_type
        int orderable_id
        int quantity
        decimal price
    }
    
    Photo {
        int id PK
        string photoable_type
        int photoable_id
        string path
        boolean is_primary
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

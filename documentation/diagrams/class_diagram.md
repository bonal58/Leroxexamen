# Klassendiagram - Lerox Motoren

## Hoofdklassen

### User 
- **Attributen:**
  - id: int
  - name: string
  - email: string
  - password: string
  - role: string
  - created_at: timestamp
  - updated_at: timestamp
- **Methoden:**
  - isAdmin(): boolean
  - getCreatedAtAttribute(): string

### Scooter
- **Attributen:**
  - id: int
  - title: string
  - description: text
  - price: decimal
  - brand: string
  - model: string
  - year: int
  - mileage: int
  - color: string
  - status: string
  - created_at: timestamp
  - updated_at: timestamp
- **Methoden:**
  - photos(): HasMany
  - getPrimaryPhoto(): Photo|null
  - getFormattedPrice(): string

### Part
- **Attributen:**
  - id: int
  - title: string
  - description: text
  - price: decimal
  - brand: string
  - model: string
  - category: string
  - stock: int
  - created_at: timestamp
  - updated_at: timestamp
- **Methoden:**
  - photos(): HasMany
  - getPrimaryPhoto(): Photo|null
  - getFormattedPrice(): string

### Photo
- **Attributen:**
  - id: int
  - filename: string
  - path: string
  - is_primary: boolean
  - photoable_id: int
  - photoable_type: string
  - created_at: timestamp
  - updated_at: timestamp
- **Methoden:**
  - photoable(): MorphTo
  - getUrl(): string

## Relaties

- **User - Scooter**: Een User kan meerdere Scooters beheren (1:n)
- **User - Part**: Een User kan meerdere Parts beheren (1:n)
- **Scooter - Photo**: Een Scooter kan meerdere Photos hebben (1:n, polymorfisch)
- **Part - Photo**: Een Part kan meerdere Photos hebben (1:n, polymorfisch)

## Polymorfische Relatie

De Photo klasse heeft een polymorfische relatie met zowel Scooter als Part via de `photoable` relatie. Dit maakt het mogelijk om dezelfde Photo klasse te gebruiken voor beide entiteiten, wat de code DRY (Don't Repeat Yourself) houdt.

De polymorfische relatie wordt gedefinieerd door:
- `photoable_id`: De ID van de gerelateerde entiteit (Scooter of Part)
- `photoable_type`: Het type van de gerelateerde entiteit (volledig gekwalificeerde klassenaam)

## Implementatie Details

In Laravel is dit geïmplementeerd met Eloquent ORM:

```php
// In Photo.php
public function photoable()
{
    return $this->morphTo();
}

// In Scooter.php
public function photos()
{
    return $this->morphMany(Photo::class, 'photoable');
}

// In Part.php
public function photos()
{
    return $this->morphMany(Photo::class, 'photoable');
}
```

Deze structuur maakt het mogelijk om foto's op een uniforme manier te beheren voor verschillende entiteiten, terwijl de code georganiseerd en onderhoudbaar blijft.

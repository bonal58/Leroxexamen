# Entity Relationship Diagram (ERD) - Lerox Motoren

## Tabellen

### users
- **id**: bigint(20) unsigned AUTO_INCREMENT PRIMARY KEY
- **name**: varchar(255) NOT NULL
- **email**: varchar(255) NOT NULL UNIQUE
- **email_verified_at**: timestamp NULL
- **password**: varchar(255) NOT NULL
- **remember_token**: varchar(100) NULL
- **role**: varchar(20) DEFAULT 'user'
- **created_at**: timestamp NULL
- **updated_at**: timestamp NULL

### scooters
- **id**: bigint(20) unsigned AUTO_INCREMENT PRIMARY KEY
- **title**: varchar(255) NOT NULL
- **description**: text NULL
- **price**: decimal(10,2) NOT NULL
- **brand**: varchar(100) NOT NULL
- **model**: varchar(100) NOT NULL
- **year**: int NOT NULL
- **mileage**: int NOT NULL
- **color**: varchar(50) NOT NULL
- **status**: varchar(50) DEFAULT 'available'
- **created_at**: timestamp NULL
- **updated_at**: timestamp NULL

### parts
- **id**: bigint(20) unsigned AUTO_INCREMENT PRIMARY KEY
- **title**: varchar(255) NOT NULL
- **description**: text NULL
- **price**: decimal(10,2) NOT NULL
- **brand**: varchar(100) NOT NULL
- **model**: varchar(100) NULL
- **category**: varchar(100) NOT NULL
- **stock**: int NOT NULL DEFAULT 0
- **created_at**: timestamp NULL
- **updated_at**: timestamp NULL

### photos
- **id**: bigint(20) unsigned AUTO_INCREMENT PRIMARY KEY
- **filename**: varchar(255) NOT NULL
- **path**: varchar(255) NOT NULL
- **is_primary**: boolean DEFAULT false
- **photoable_id**: bigint(20) unsigned NOT NULL
- **photoable_type**: varchar(255) NOT NULL
- **created_at**: timestamp NULL
- **updated_at**: timestamp NULL

### password_reset_tokens
- **email**: varchar(255) PRIMARY KEY
- **token**: varchar(255) NOT NULL
- **created_at**: timestamp NULL

### failed_jobs
- **id**: bigint(20) unsigned AUTO_INCREMENT PRIMARY KEY
- **uuid**: varchar(255) NOT NULL UNIQUE
- **connection**: text NOT NULL
- **queue**: text NOT NULL
- **payload**: longtext NOT NULL
- **exception**: longtext NOT NULL
- **failed_at**: timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP

### personal_access_tokens
- **id**: bigint(20) unsigned AUTO_INCREMENT PRIMARY KEY
- **tokenable_type**: varchar(255) NOT NULL
- **tokenable_id**: bigint(20) unsigned NOT NULL
- **name**: varchar(255) NOT NULL
- **token**: varchar(64) NOT NULL UNIQUE
- **abilities**: text NULL
- **last_used_at**: timestamp NULL
- **expires_at**: timestamp NULL
- **created_at**: timestamp NULL
- **updated_at**: timestamp NULL

## Relaties

1. **Polymorfische relatie tussen photos en andere entiteiten**:
   - `photos.photoable_id` en `photos.photoable_type` vormen samen een polymorfische relatie
   - Wanneer `photoable_type` = 'App\\Models\\Scooter', dan verwijst `photoable_id` naar een record in de `scooters` tabel
   - Wanneer `photoable_type` = 'App\\Models\\Part', dan verwijst `photoable_id` naar een record in de `parts` tabel

2. **Indexen**:
   - Samengestelde index op `photoable_id` en `photoable_type` in de `photos` tabel voor efficiënte queries
   - Index op `email` in de `users` tabel voor snelle authenticatie
   - Index op `tokenable_id` en `tokenable_type` in de `personal_access_tokens` tabel

## Databasemigraties

De database is opgebouwd via Laravel migraties, wat zorgt voor versiebeheer van het databaseschema. Belangrijke migraties zijn:

1. Standaard Laravel authenticatie tabellen
2. Scooters tabel voor het opslaan van scooter informatie
3. Parts tabel voor het opslaan van onderdelen informatie
4. Photos tabel met polymorfische relaties voor het opslaan van afbeeldingen
5. Toevoeging van de role kolom aan de users tabel voor autorisatie

## Voordelen van dit ERD

1. **Normalisatie**: De database is genormaliseerd om redundantie te minimaliseren
2. **Polymorfische relaties**: Efficiënt hergebruik van de photos tabel voor verschillende entiteiten
3. **Schaalbaarheid**: De structuur kan eenvoudig worden uitgebreid met nieuwe entiteiten
4. **Integriteit**: Relaties zorgen voor data-integriteit
5. **Performance**: Indexen zijn strategisch geplaatst voor optimale query performance

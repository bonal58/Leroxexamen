<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Scooter Model
 *
 * Dit model representeert een scooter in het systeem van Lerox Motoren.
 * Het bevat alle eigenschappen van een scooter zoals merk, model, prijs, etc.
 * en relaties met andere modellen zoals onderdelen en foto's.
 */
class Scooter extends Model
{
    use HasFactory; // Maakt het mogelijk om factory's te gebruiken voor het genereren van testdata
    
    /**
     * De attributen die toegewezen kunnen worden
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'brand',
        'model',
        'description',
        'price',
        'year',
        'color',
        'stock',
        'image',
        'featured',
    ];
    
    /**
     * De attributen die gecast moeten worden
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'stock' => 'integer',
        'featured' => 'boolean',
    ];
    
    /**
     * De onderdelen die compatibel zijn met deze scooter
     * 
     * Deze methode definieert een many-to-many relatie tussen scooters en onderdelen.
     * Hiermee kunnen we alle onderdelen ophalen die compatibel zijn met een specifieke scooter.
     * De relatie wordt opgeslagen in de tussentabel 'part_scooter'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function compatibleParts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class);
    }
    
    /**
     * De foto's van deze scooter
     * 
     * Deze methode definieert een polymorfische one-to-many relatie met het Photo model.
     * Hiermee kunnen we alle foto's ophalen die bij een specifieke scooter horen.
     * Door het gebruik van een polymorfische relatie kunnen zowel scooters als onderdelen
     * dezelfde foto-functionaliteit gebruiken zonder duplicatie van code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
    
    /**
     * De primaire foto van deze scooter
     * 
     * Deze methode haalt de primaire foto van de scooter op. Als er geen foto expliciet als
     * primair is gemarkeerd, wordt de eerste beschikbare foto geretourneerd. Als er helemaal
     * geen foto's zijn, wordt null geretourneerd.
     * 
     * @return \App\Models\Photo|null
     */
    public function primaryPhoto()
    {
        return $this->photos()->where('is_primary', true)->first() ?? $this->photos()->first();
    }
    
    /**
     * Controleer of deze scooter foto's heeft
     * 
     * Deze methode controleert of er foto's aan deze scooter zijn gekoppeld.
     * Wordt gebruikt om te bepalen of er een foto-galerij moet worden weergegeven.
     * 
     * @return bool
     */
    public function hasPhotos(): bool
    {
        return $this->photos()->count() > 0;
    }
    
    /**
     * De bestelitems voor deze scooter
     * 
     * Deze methode definieert een polymorfische one-to-many relatie met het OrderItem model.
     * Hiermee kunnen we alle bestelitems ophalen die bij een specifieke scooter horen.
     * Door het gebruik van een polymorfische relatie kunnen zowel scooters als onderdelen
     * en diensten in bestellingen worden opgenomen zonder duplicatie van code.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }
}

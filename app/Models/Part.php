<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Onderdeel Model
 *
 * Dit model representeert een onderdeel in het systeem van Lerox Motoren.
 * Het bevat alle eigenschappen van een onderdeel zoals naam, categorie, prijs, etc.
 * en relaties met andere modellen zoals scooters en foto's.
 * Elk onderdeel heeft een uniek SKU (Stock Keeping Unit) nummer.
 */
class Part extends Model
{
    use HasFactory; // Maakt het mogelijk om factory's te gebruiken voor het genereren van testdata
    
    /**
     * De attributen die toegewezen kunnen worden
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'sku',
        'stock',
        'image',
        'compatible_with_all',
    ];
    
    /**
     * De attributen die gecast moeten worden
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'compatible_with_all' => 'boolean',
    ];
    
    /**
     * De scooters waarmee dit onderdeel compatibel is
     * 
     * Deze methode definieert een many-to-many relatie tussen onderdelen en scooters.
     * Hiermee kunnen we alle scooters ophalen waarmee een specifiek onderdeel compatibel is.
     * De relatie wordt opgeslagen in de tussentabel 'part_scooter'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function compatibleScooters(): BelongsToMany
    {
        return $this->belongsToMany(Scooter::class);
    }
    
    /**
     * De foto's van dit onderdeel
     * 
     * Deze methode definieert een polymorfische one-to-many relatie met het Photo model.
     * Hiermee kunnen we alle foto's ophalen die bij een specifiek onderdeel horen.
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
     * De primaire foto van dit onderdeel
     * 
     * Deze methode haalt de primaire foto van het onderdeel op. Als er geen foto expliciet als
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
     * Controleer of dit onderdeel foto's heeft
     * 
     * Deze methode controleert of er foto's aan dit onderdeel zijn gekoppeld.
     * Wordt gebruikt om te bepalen of er een foto-galerij moet worden weergegeven.
     * 
     * @return bool
     */
    public function hasPhotos(): bool
    {
        return $this->photos()->count() > 0;
    }
    
    /**
     * De bestelitems voor dit onderdeel
     * 
     * Deze methode definieert een polymorfische one-to-many relatie met het OrderItem model.
     * Hiermee kunnen we alle bestelitems ophalen die bij een specifiek onderdeel horen.
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

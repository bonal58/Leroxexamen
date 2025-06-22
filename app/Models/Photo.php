<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Foto Model
 *
 * Dit model representeert een foto in het systeem van Lerox Motoren.
 * Het wordt gebruikt voor het opslaan van foto's van zowel scooters als onderdelen
 * door middel van een polymorfische relatie. Elke foto heeft een pad naar het bestand,
 * een vlag die aangeeft of het de primaire foto is, en een volgorde.
 */
class Photo extends Model
{
    use HasFactory; // Maakt het mogelijk om factory's te gebruiken voor het genereren van testdata
    
    /**
     * De attributen die toegewezen kunnen worden
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'is_primary',
        'order',
    ];
    
    /**
     * De attributen die gecast moeten worden
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
        'order' => 'integer',
    ];
    
    /**
     * Krijg het eigenaar model (scooter, part, etc.)
     *
     * Deze methode definieert een polymorfische relatie waarmee de foto kan bepalen
     * bij welk model het hoort (scooter, onderdeel, etc.). Dit maakt het mogelijk om
     * dezelfde foto-functionaliteit te gebruiken voor verschillende modellen zonder
     * duplicatie van code. De 'photoable_id' en 'photoable_type' kolommen in de database
     * worden gebruikt om te bepalen bij welk specifiek object deze foto hoort.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function photoable(): MorphTo
    {
        return $this->morphTo();
    }
}

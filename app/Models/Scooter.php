<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Scooter extends Model
{
    use HasFactory;
    
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
     */
    public function compatibleParts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class);
    }
    
    /**
     * De foto's van deze scooter
     */
    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
    
    /**
     * De primaire foto van deze scooter
     */
    public function primaryPhoto()
    {
        return $this->photos()->where('is_primary', true)->first() ?? $this->photos()->first();
    }
    
    /**
     * Controleer of deze scooter foto's heeft
     */
    public function hasPhotos(): bool
    {
        return $this->photos()->count() > 0;
    }
    
    /**
     * De bestelitems voor deze scooter
     */
    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }
}

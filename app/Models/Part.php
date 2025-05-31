<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Part extends Model
{
    use HasFactory;
    
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
     */
    public function compatibleScooters(): BelongsToMany
    {
        return $this->belongsToMany(Scooter::class);
    }
    
    /**
     * De foto's van dit onderdeel
     */
    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
    
    /**
     * De primaire foto van dit onderdeel
     */
    public function primaryPhoto()
    {
        return $this->photos()->where('is_primary', true)->first() ?? $this->photos()->first();
    }
    
    /**
     * Controleer of dit onderdeel foto's heeft
     */
    public function hasPhotos(): bool
    {
        return $this->photos()->count() > 0;
    }
    
    /**
     * De bestelitems voor dit onderdeel
     */
    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }
}

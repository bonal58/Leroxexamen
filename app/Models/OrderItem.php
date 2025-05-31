<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderItem extends Model
{
    use HasFactory;
    
    /**
     * De attributen die toegewezen kunnen worden
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'orderable_id',
        'orderable_type',
        'quantity',
        'price',
        'total',
    ];
    
    /**
     * De attributen die gecast moeten worden
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
        'quantity' => 'integer',
    ];
    
    /**
     * De bestelling waartoe dit item behoort
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
    /**
     * Het product (scooter of onderdeel) dat besteld is
     */
    public function orderable(): MorphTo
    {
        return $this->morphTo();
    }
}

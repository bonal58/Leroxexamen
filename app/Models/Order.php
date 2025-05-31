<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    
    /**
     * De attributen die toegewezen kunnen worden
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'shipping_address',
        'billing_address',
        'tracking_number',
        'notes',
    ];
    
    /**
     * De attributen die gecast moeten worden
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
    ];
    
    /**
     * De gebruiker die deze bestelling heeft geplaatst
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * De items in deze bestelling
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

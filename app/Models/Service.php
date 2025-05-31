<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\QuoteRequest;

class Service extends Model
{
    use HasFactory;
    
    /**
     * De attributen die toegewezen kunnen worden
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'image',
        'featured',
        'category',
        'price_range',
    ];
    
    /**
     * De attributen die gecast moeten worden
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
    ];
    
    /**
     * De offerteaanvragen voor deze service
     */
    public function quoteRequests(): HasMany
    {
        return $this->hasMany(QuoteRequest::class);
    }
}

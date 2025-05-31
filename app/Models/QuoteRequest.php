<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Service;

class QuoteRequest extends Model
{
    use HasFactory;
    
    /**
     * De attributen die toegewezen kunnen worden
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'service_id',
        'name',
        'email',
        'phone',
        'message',
        'scooter_model',
        'scooter_year',
        'status',
        'quoted_price',
    ];
    
    /**
     * De attributen die gecast moeten worden
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quoted_price' => 'decimal:2',
        'scooter_year' => 'integer',
    ];
    
    /**
     * De gebruiker die deze offerteaanvraag heeft gedaan
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * De service waarvoor deze offerteaanvraag is gedaan
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}

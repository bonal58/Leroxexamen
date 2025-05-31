<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Photo extends Model
{
    use HasFactory;
    
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
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function photoable(): MorphTo
    {
        return $this->morphTo();
    }
}

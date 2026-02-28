<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Card model.
 *
 * Represents an individual Pokémon card contained in a pack.
 */
class Card extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'price',
        'collection',
        'status',
        'productions',
        'pack_id',
        'image',
    ];

    /**
     * Pack this card belongs to.
     *
     * @return BelongsTo
     */
    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Pack model.
 *
 * Represents a Pokémon pack belonging to a box.
 * A pack contains multiple cards.
 */
class Pack extends Model
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
        'productions',
        'box_id',
    ];

    /**
     * Box that owns this pack.
     *
     * @return BelongsTo
     */
    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    /**
     * Cards contained in this pack.
     *
     * @return HasMany
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}


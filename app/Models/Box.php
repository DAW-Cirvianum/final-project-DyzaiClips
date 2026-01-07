<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Box model.
 *
 * Represents a Pokémon box that contains multiple packs.
 */
class Box extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'productions',
    ];

    /**
     * Packs contained in the box.
     *
     * @return HasMany
     */
    public function packs(): HasMany
    {
        return $this->hasMany(Pack::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Product model.
 *
 * Represents a marketplace product such as a Pokémon card, pack, or box.
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'type',
        'image_url', 
    ];

    /**
     * Price and condition variations of the product.
     *
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(ProductValue::class);
    }

    /**
     * Users who own this product.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

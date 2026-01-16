<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * ProductValue model.
 *
 * Represents a price and condition variation of a product.
 * For example: new / used cards with different prices and stock.
 */
class ProductValue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_id',
        'condition',
        'price',
        'stock',
    ];

    /**
     * Product associated with this value.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Transactions that include this product value.
     *
     * @return BelongsToMany
     */
    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class);
    }
}

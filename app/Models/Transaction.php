<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Transaction model.
 *
 * Represents a marketplace transaction between a buyer and a seller.
 * A transaction can include multiple product values.
 */
class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'total_price',
        'status',
    ];

    /**
     * Buyer involved in the transaction.
     *
     * @return BelongsTo
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Seller involved in the transaction.
     *
     * @return BelongsTo
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Product values included in this transaction.
     *
     * @return BelongsToMany
     */
    public function productValues(): BelongsToMany
    {
        return $this->belongsToMany(ProductValue::class);
    }
}


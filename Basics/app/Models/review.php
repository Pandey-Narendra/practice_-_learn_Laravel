<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment'   
    ];

    /**
     * Relationship: Review belongs to a User.
     * Meaning: Each review is written by exactly one user.
     * Database: reviews.user_id → users.id
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Review belongs to a Product.
     * Meaning: Each review is for exactly one product.
     * Database: reviews.product_id → products.id
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }
}

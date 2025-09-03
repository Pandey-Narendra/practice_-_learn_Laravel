<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock'
    ];

    /**
     * Relationship: Product belongs to many Orders through order_items pivot table.
     * Meaning: A product can appear in many different orders.
     * Database: order_items.product_id → products.id AND order_items.order_id → orders.id
     */
    public function orders() {
        return $this->belongsToMany(Order::class, 'order_items');
    }

    /**
     * Relationship: Product belongs to many Categories through product_categories pivot table.
     * Meaning: A product can belong to multiple categories.
     * Database: product_categories.product_id → products.id AND product_categories.category_id → categories.id
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    /**
     * Relationship: Product has many Reviews.
     * Meaning: Many users can leave reviews for the same product.
     * Database: reviews.product_id → products.id
     */
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}

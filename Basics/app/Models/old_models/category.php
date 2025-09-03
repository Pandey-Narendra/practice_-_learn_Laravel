<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Relationship: Category belongs to many Products through product_categories pivot table.
     * Meaning: A category can have many products, and a product can belong to many categories.
     * Database: product_categories.category_id → categories.id AND product_categories.product_id → products.id
     */
    public function products() {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}

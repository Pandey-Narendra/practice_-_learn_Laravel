<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status'
    ];

    /**
     * Relationship: Order belongs to a User.
     * Meaning: Each order is placed by exactly one user.
     * Database: orders.user_id → users.id
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Order belongs to many Products through order_items pivot table.
     * Meaning: An order can contain multiple products, and each product can be in many orders.
     * Database: order_items.order_id → orders.id AND order_items.product_id → products.id
     */
    public function products() {
        return $this->belongsToMany(Product::class, 'order_items');
    }
}

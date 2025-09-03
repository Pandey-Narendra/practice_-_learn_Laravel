<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    /**
     * Relationship: OrderItem belongs to an Order.
     * Meaning: This row represents one product inside a specific order.
     * Database: order_items.order_id → orders.id
     */
    public function order() {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relationship: OrderItem belongs to a Product.
     * Meaning: This row represents a specific product in an order.
     * Database: order_items.product_id → products.id
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }
}

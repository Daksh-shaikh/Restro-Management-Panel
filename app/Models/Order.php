<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "order";

    protected $fillable = [
        'order_id2',
        'user_id',
        'restro_id',
        'order_date',
        // 'recipe_price',
        'contact_number',
        'address',
        'total',
        'discount',
        'payment_mode',
        'delivery_type',
        'delivery_charges',
        'coupon_code',
        'status',
        'restro_status',
        'delivery_status',
        'longitude',
        'latitude',

    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'order_id', 'id');
    }

    public function deliveryAddress()
    {
        return $this->hasOne(DeliveryAddress::class, 'user_id', 'user_id'); // Adjust the relationship based on your actual database structure
    }

    public function restro()
    {
        return $this->hasOne(Restro::class, 'id', 'restro_id');
    }
}

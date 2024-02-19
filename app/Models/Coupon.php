<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = "coupon";

    protected $fillable = [
        'restaurant_id',
        'code',
        'dstype',
        'value',
        'start_from',
        'upto',
        'min_cost',
        'status',


    ];


    public function restaurant_name()
    {
        return $this->hasOne(Restro::class, 'id', 'restaurant_id');
    }
}

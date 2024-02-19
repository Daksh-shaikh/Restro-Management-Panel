<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = "recipe";

    protected $fillable = [
        'category_id',
        'restaurant_id',
        'city_id',
        'recipe',
        'price',
        'food',
        'image',
        'description',
        'status',

    ];

    public function category_name()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

       /**
     * Get the restaurant associated with the recipe.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restro::class, 'restaurant_id', 'id');
    }
}

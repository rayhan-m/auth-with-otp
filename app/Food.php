<?php

namespace App;

use App\FoodCategory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'category_id', 'id');
    }
}
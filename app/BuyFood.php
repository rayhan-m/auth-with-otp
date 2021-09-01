<?php

namespace App;

use App\Food;
use Illuminate\Database\Eloquent\Model;

class BuyFood extends Model
{
    /**
     * Get the user that owns the BuyFood
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function foodName()
    {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }
}
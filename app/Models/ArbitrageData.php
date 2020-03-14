<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrageData extends Model
{
    protected $fillable = [
        'execution',
        'coin',
        'buy_exchange',
        'buy_price',
        'sell_exchange',
        'sell_price',
        'profit',
    ];

}

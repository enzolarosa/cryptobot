<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArbitrageData.
 *
 * @property string $execution
 * @property string coin_from
 * @property string coin_to
 * @property string coin
 * @property string buy_exchange
 * @property string buy_price
 * @property string sell_exchange
 * @property string sell_price
 * @property float profit
 */
class ArbitrageData extends Model
{
    protected $fillable = [
        'execution',
        'coin_from',
        'coin_to',
        'coin',
        'buy_exchange',
        'buy_price',
        'sell_exchange',
        'sell_price',
        'profit',
    ];

    protected static function booting()
    {
        parent::booting();
        static::saving(function (self $data) {
            $coin = explode('-', $data->coin);
            $data->coin_from = $coin[0];
            $data->coin_to = $coin[1];
        });
    }
}

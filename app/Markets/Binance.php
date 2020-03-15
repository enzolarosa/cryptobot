<?php

// https://github.com/binance-exchange/php-binance-api

namespace App\Markets;

use Throwable;

class Binance extends Market
{
    /**
     * Authenticate to Market, get the token to perform any operation.
     *
     * @return string
     * @throws Throwable
     */
    public function authenticate(): string
    {
        return $this->call([
            'endpoint' => '/',
            'method' => 'post',
        ])->body();
    }

    public function move($buy, $sell): bool
    {
        // TODO: Implement move() method.
    }

    public function transfer($from, $to): bool
    {
        // TODO: Implement transfer() method.
    }
}

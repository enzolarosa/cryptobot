<?php

namespace App\Markets;

class CoinbasePro extends MarketAbstract
{
    const BASE = 'https://api.pro.coinbase.com';

    public function __construct()
    {
        parent::__construct();
        $this->setBase(self::BASE);
    }

    /**
     * Authenticate to Market, get the token to perform any operation.
     *
     * @return string
     */
    public function authenticate(): string
    {
        return $this->call([
            'endpoint' => '/',
            'method' => 'post',
        ])->body();
    }
}

<?php

namespace App\Markets;

class CoinbasePro extends Market
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
     * @throws \Throwable
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

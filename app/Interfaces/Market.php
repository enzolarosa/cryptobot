<?php

namespace App\Interfaces;

interface Market
{
    /**
     * Authenticate to Market, get the token to perform any operation.
     *
     * @return string
     */
    public function authenticate(): string;

    public function move($buy, $sell): bool;

    public function transfer($from, $to): bool;
}

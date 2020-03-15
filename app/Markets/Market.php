<?php

namespace App\Markets;

use App\Interfaces\Market as MarketInterface;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Throwable;

abstract class Market implements MarketInterface
{
    protected string $base;

    protected array $mustHave = [
        'method',
        'endpoint',
    ];

    /**
     * @return string
     */
    public function getBase(): string
    {
        return $this->base;
    }

    /**
     * @param string $base
     * @return Market
     */
    public function setBase(string $base): self
    {
        $this->base = $base;

        return $this;
    }

    public function __construct()
    {
    }

    /**
     * @param array $options
     * @return Response
     * @throws Throwable
     */
    protected function call(array $options = [])
    {
        collect($this->mustHave)->each(function ($option) use ($options) {
            throw_if(! Arr::exists($options, $option), new Exception("`$option` is missing in the `options` array. Please add it!"));
        });

        return Http::withHeaders($options['headers'] ?? [])
            ->{$options['method']}($this->getBase().$options['endpoint']);
    }
}

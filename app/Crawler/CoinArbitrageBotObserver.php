<?php

namespace App\Crawler;

use App\Models\ArbitrageData;
use DOMDocument;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\CrawlObserver;

class CoinArbitrageBotObserver extends CrawlObserver
{
    /** @var string $code */
    protected $code;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return CoinArbitrageBotObserver
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null)
    {
        $doc = new DOMDocument();
        @$doc->loadHTML($response->getBody());
        $table = $doc->getElementById('arbi');

        $rows = $table->getElementsByTagName("tr");
        $header = [];
        foreach ($rows as $i => $row) {
            $cells = $row->getElementsByTagName('td');
            $c = [];
            foreach ($cells as $cell) {
                $val = $cell->nodeValue;
                if ($i == 0) {
                    $val = $this->fieldName($val);
                }
                $c[] = $val;
            }
            if ($i == 0) {
                $header = $c;
            } else {
                $body = array_combine($header, $c);
                $body['execution'] = $this->getCode();
                ArbitrageData::query()->create($body);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function crawlFailed(UriInterface $url, RequestException $requestException, ?UriInterface $foundOnUrl = null)
    {
        dd("crawlFail", $url, $requestException, $foundOnUrl);
    }

    /**
     * @param string $field
     *
     * @return string
     */
    protected function fieldName(string $field): string
    {
        return Str::substr(Str::snake(str_replace("%", "", $field)), 0, 64);
    }
}


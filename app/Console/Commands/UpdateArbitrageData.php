<?php

namespace App\Console\Commands;

use App\Jobs\GetArbitrageData;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateArbitrageData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arbitrage:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the arbitrage date from coinarbitragebot.com';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('['.now()->toDateTimeString().'] Crawler will start soon');
        $code = Str::uuid();
        $this->comment('['.now()->toDateTimeString()."] this is the code for this execution $code");
        $markets = collect([
            'bibox',
            'coinbase',
            'binance',
            'digifinex',
            'okex',
            'zb.com',
            'cointiger',
            'poloniex',
            'kraken',
            'bitfinex',
            'coinsbit',
            'catex',
            'sistemkoin',
            'zbg',
            'bittrex',
            'lbank',
            'bw.com',
            'bithumb',
            'upbit',
            'yobit',
            'hitbtc',
            'crex24',
            'cex.io',
            'dcoin',
            'coincheck',
            'bitso',
            'mxc',
            'p2pb2b',
            'bitstamp',
            'kucoin',
            'liquid',
            'hotbit',
            'mercatox',
            'bitforex',
            'livecoin',
            'huobi',
            'graviex',
            'stex',
            'indodax',
            'bitbns',
            'coinbene',
            'gate.io',
            'tradeogre',
            'bitmart',
            'exmo',
            'btcturk',
            'bitmax',
            'biki',
            'koineks',
            'coindeal',
            'bitkub',
            'coineal',
            'bitrue',
            'finexbox',
            'fatbtc',
            'coinall',
            'bleutrade',
            'okcoin',
            'tokok',
            'bit-z',
            'simex',
            'latoken',
            'exx.com',
        ]);
        $base = 'https://coinarbitragebot.com/market.php?ex=';
        $markets->each(function ($market, $index) use ($base, $code) {
            $url = sprintf('%s', $base.$market);

            $this->info(sprintf('[%s][%d] Starting with %s', now()->toDateTimeString(), $index + 1, $url));
            $job = (new GetArbitrageData())->setUrl($url)->setCode($code);
            dispatch_now($job);
        });

        $this->info('Crawler job finish');
    }
}

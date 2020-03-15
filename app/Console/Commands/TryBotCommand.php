<?php

namespace App\Console\Commands;

use App\Markets\CoinbasePro;
use Illuminate\Console\Command;

class TryBotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:try';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $coinbase = new CoinbasePro();

        dd($coinbase->authenticate());
    }
}

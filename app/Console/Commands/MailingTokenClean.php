<?php

namespace ActivismeBE\Console\Commands;

use ActivismeBE\Tokens;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MailingTokenClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleaning the security tokens database table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $entries = Tokens::where('created_at', '<', Carbon::now()->subMinutes(60)->toDateTimeString())->delete();

        dd($entries);
    }
}

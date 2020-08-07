<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SearchList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:equal {key}';
    protected $signature2 = 'search:like {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $key = $this->ask('key: ');
        $arguments = $this->arguments();
        return 0;
    }
}

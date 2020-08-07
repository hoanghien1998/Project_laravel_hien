<?php

namespace App\Console\Commands;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


class BookList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'book:list';

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

        try{

            $jsonString = Storage::disk('local')->get('books.json');
            $data = json_decode($jsonString, true);
            dump($data);
            dd();

        }
        catch (Exception $e)
        {
            $this->error("Fail!");
        }
        return 0;

    }
}

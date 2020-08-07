<?php

namespace App\Console\Commands;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

// Read file books json to show all books in booklist
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
    protected $description = 'Command show all booklist';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try
        {
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

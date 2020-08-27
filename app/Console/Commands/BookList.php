<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Read file books json to show all books in booklist
 *
 * @package App\Console\Commands
 */
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
     * Execute the console command.
     *
     * @return integer
     */
    public function handle()
    {
        try {
            $jsonString = Storage::disk('local')->get('books.json');
            $data = collect($jsonString, true);
            $this->info($data);
        } catch (Exception $e) {
            $this->error("Fail!");
        }

        return 0;
    }
}

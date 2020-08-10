<?php

/**
 * Just add simple doc
 *
 * @category BookSearch
 *
 * @package  App\Console\Commands
 *
 * phpcs.xml
 */
namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * Class BookSearch
 * Command BookSearch allow to search books by keyword or published from hard-code json file.
 *
 * @package App\Console\Commands
 */
class SearchList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'book:search {keyword=lalala} {published=2014-12-01}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search books by keyword or published and display.';

    /**
     * Execute the console command.
     *
     * @return integer
     * @throws FileNotFoundException
     */
    public function handle()
    {
        // Get parameter from command
        $keyword = $this->argument('keyword');
        $published = $this->argument('published');

        try {
            // Get data from file books.json stored in storage
            $jsonString = Storage::disk('local')->get('books.json');

            // Parse json to array
            $data = json_decode($jsonString, true);

            // Parse array to collection
            $books = collect(collect($data)['books']);

            // Filter books containing keyword and published parameter
            $matchedBooks1 = $books->filter(function ($book) use ($keyword, $published) {
                // TODO Should use `Carbon`
                // Create date from parameter
                $date = date_create($published);

                // Format input date
                $dateFormat = date_format($date, "Y-m-d");

                $resultInDate = str_contains($book['published'], $dateFormat);

                if ($resultInDate == null) {
                    return null;
                }

                // Check contain
                $resultInTitle = str_contains($book['title'], $keyword);

                if ($resultInTitle) {
                    return $resultInTitle;
                }

                $resultInDes = str_contains($book['description'], $keyword);

                if ($resultInDes) {
                    return $resultInDes;
                }
            });

            // Iterates through the collection and
            // get fields `isbn`, `title`, `published`, `pages` for each row
            $collection1 = $matchedBooks1->map(function ($item) {
                return [
                    'isbn' => $item['isbn'],
                    'title' => $item['title'],
                    'published' => $item['published'],
                    'pages' => $item['pages']
                ];
            });

            $this->info($collection1);
        } catch (Exception $e) {
            $this->error($e);
        }

        return 0;
    }
}

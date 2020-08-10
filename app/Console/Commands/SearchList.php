<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


// SearchList according to the key equal and like
class SearchList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:book {--Published} {--key}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command search list key equal and like';

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
        $pub = $this->ask('Published: ');
        $key = $this->ask('key: ');

        try {
            $gender = $this->options('search', ['Published', 'key']);
            $getString = Storage::disk('local')->get('books.json');
            $data = json_decode($getString, true);
            $books = collect(collect($data)['books']);

            if (($gender == "key") && ($gender == "Published")) {
                $fillBook = $books->filter(function ($book) use ($key, $pub) {
                    $date = data_create($pub);
                    $dateFormat = date_format($date, "Y-m-d");

                    $resultTitle = str_contains($book['title'], $key);
                    $resultDes = str_contains($book['description'], $key);

                    if ($resultTitle != null) {
                        $reultPublish = str_contains($book['published'], $dateFormat);

                        if ($reultPublish != null) {
                            return $resultTitle;
                        }
                        return null;
                    }

                    if ($resultDes != null) {
                        $reultPublish = str_contains($book['published'], $dateFormat);

                        if ($reultPublish != null) {
                            return $resultDes;
                        }
                        return null;
                    }

                    return null;
                });

                $option = $fillBook->map(function ($item) {
                    return ['isbn' => $item['isbn'], 'title' => $item['title'], 'published' => $item['published'], 'pages' => $item['pages']];
                });
                $this->info($option);

            }
        } catch (Exception $e) {
            $this->error('Fail');
        }

        return 0;
    }
}

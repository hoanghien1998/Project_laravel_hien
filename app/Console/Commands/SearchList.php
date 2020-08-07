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
    protected $signature = 'search:book {--key=}';


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
        //$pub = $this->ask('Published: ');
        $key = $this->ask('key: ');

        try
        {
            $gender = $this->anticipate('search', ['Published', 'key']);
            $getString = Storage::disk('local')->get('books.json');
            $data = json_decode($getString, true);
            $books = collect(collect($data)['books']);

            if($gender == "key")
            {
                try {
                    $matchedBooks1 = $books->filter(function ($book) use($key) {
                        $resultInTitle  = str_contains($book['title'], $key);
                        $resultInDes = str_contains($book['description'], $key);
                        if($resultInTitle != null)
                            return $resultInTitle;
                        if($resultInDes != null)
                            return $resultInDes;
                        return null;
                    });
                    $collection1 = $matchedBooks1->map(function ($item) {
                        return ['isbn' => $item['isbn'], 'title' => $item['title'], 'published' => $item['published'], 'pages' => $item['pages']];
                    });

                    dd($collection1);
                }
                catch (Exception $e)
                {
                    $this->error("Your key can't find");
                }

            }

            if ($gender == "Published")
            {
                try {
                    $matchedBooks2 = $books->filter(function ($book) use($key) {
                        $date = date_create($key);
                        $dateFormat = date_format($date,"Y-m-d");
                        return str_contains($book['published'], $dateFormat);;
                    });
                    $collection2 = $matchedBooks2->map(function ($item) {
                        return ['isbn' => $item['isbn'], 'title' => $item['title'], 'published' => $item['published'], 'pages' => $item['pages']];
                    });
                    dd($collection2);
                }
                catch (Exception $e)
                {
                    $this->error('Wrong format datetime');
                }
            }
        }

        catch (Exception $e)
        {
            $this->error('Fail');
        }

        return 0;
    }
}

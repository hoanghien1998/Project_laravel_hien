<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 * Use call UsersTableSeeder execute
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}

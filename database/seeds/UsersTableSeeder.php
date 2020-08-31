<?php

use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder insert 50 users at table users
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create();
    }
}

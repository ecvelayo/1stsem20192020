<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TrainingsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(ChaptersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}

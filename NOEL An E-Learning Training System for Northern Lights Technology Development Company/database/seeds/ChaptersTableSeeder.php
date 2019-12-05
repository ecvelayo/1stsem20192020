<?php

use App\Chapter;
use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chapters = [
            [
                'title' => 'Be early',
                'section_id' => 1,
                'index' => 0
            ],
            [
                'title' => 'Be ready',
                'section_id' => 1,
                'index' => 1
            ],
            [
                'title' => 'Motivate',
                'section_id' => 2,
                'index' => 0
            ],
        ];

        foreach($chapters as $chapter) {
            Chapter::create($chapter);
        }
    }
}

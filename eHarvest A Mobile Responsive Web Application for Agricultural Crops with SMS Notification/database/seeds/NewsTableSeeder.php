<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Db::table('news')->insert([
            [

            'news_name' => 'slide1',
            'photo' => 'https://storage.googleapis.com/eharvest-files/news/photos/slideshow1.png',
     
           

            ],
            [

                'news_name' => 'slide2',
               'photo' => 'https://storage.googleapis.com/eharvest-files/news/photos/slideshow2.png',
               
    
                ],
                [

                    'news_name' => 'slide3',
                    'photo' => 'https://storage.googleapis.com/eharvest-files/news/photos/slideshow3.jpg',
                   
        
                    ]
        ]);

    }
}

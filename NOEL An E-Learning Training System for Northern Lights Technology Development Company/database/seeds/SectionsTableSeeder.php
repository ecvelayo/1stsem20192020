<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'title' => 'Introduction',
                'training_id' => 1,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, voluptatum nesciunt sapiente distinctio accusantium similique, a ipsum dicta recusandae quidem inventore quia porro? Alias nisi architecto doloribus dignissimos assumenda reiciendis?'
            ],
            [
                'title' => 'Getting Ready',
                'training_id' => 1,
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum, dicta non! Quasi quaerat sit labore saepe possimus ab libero? Quae voluptatem at esse tenetur quos repellendus exercitationem impedit atque rem.'
            ],
            [
                'title' => 'Exercise',
                'training_id' => 2,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis placeat laborum obcaecati consequatur iure. Commodi incidunt dolor iusto sunt aliquid quae, at provident optio id facere error expedita culpa laborum.'
            ],
            [
                'title' => 'Start',
                'training_id' => 2,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quam veniam repellendus, incidunt rem voluptatem id tempora! Ullam tempore, repudiandae, velit quasi consectetur ab nihil id quia accusantium natus esse.'
            ],
            [
                'title' => 'Be Confident',
                'training_id' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto obcaecati quaerat ex natus. Ullam ratione facere atque rem dolores commodi totam et reiciendis animi nobis, recusandae ipsa eaque doloribus harum.'
            ],
            [
                'title' => 'Say it Loud',
                'training_id' => 3,
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam voluptas, assumenda dicta ipsum architecto cum, possimus soluta voluptatibus eveniet ab dolorum modi rerum cupiditate sed provident, error eum voluptate minus.'
            ]
        ];

        foreach($sections as $section) {
            Section::create($section);
        }
    }
}

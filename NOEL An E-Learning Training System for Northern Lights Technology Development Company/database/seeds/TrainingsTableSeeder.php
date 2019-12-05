<?php

use App\Training;
use Illuminate\Database\Seeder;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trainings = [
            [
                'title' => 'Time Management',
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed nisi numquam dolores unde eveniet mollitia eos nulla harum rem. Dolor delectus reiciendis asperiores voluptas distinctio fuga enim itaque atque deserunt.'
            ],
            [
                'title' => 'Leadership Skills',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos quasi ducimus fuga sequi, eligendi omnis voluptate magnam dolores odit, quod expedita tempora quisquam quos nobis cum distinctio tenetur laudantium rerum.'
            ],
            [
                'title' => 'Speaking skills',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, quibusdam officiis. Recusandae cum, vero magni nisi rem voluptate ipsam dolorum iste temporibus voluptatum libero ad, inventore odio iure. Ex, dolore?'
            ],
        ];

        foreach($trainings as $training) {
            Training::create($training);
        }
    }
}

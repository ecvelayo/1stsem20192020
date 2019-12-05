<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [

            'product_name' => 'Apple',
            'types_id' => 1,
            'product_description' => 'This fruit has a round shape and red color with creamy flesh.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/apple.jpg',
            'price' => null,
            'srp' => 15,
            'markup' => 15,
            'units_id' => 1,

        ],[ 

            'product_name' => 'Banana',
            'types_id' => 1,
            'product_description' => 'A curved, yellow fruit with a thick skin and soft sweet flesh.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/banana.jpg',
            'price' => null,
            'srp' => 50,
            'markup' => 15,
            'units_id' => 5,
        ],[

            'product_name' => 'Avocado',
            'types_id' => 1,
            'product_description' => 'A large, fleshy, pear-shaped fruit with a single large seed.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/avocado.jpeg',
            'price' => null,
            'srp' => 20,
            'markup' => 15,
            'units_id' => 1,
        ],[

            'product_name' => 'Tomato',
            'types_id' => 1,
            'product_description' => 'A vary in shape from almost spherical to oval and elongate to pear-shaped.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/tomato.jpeg',
            'price' => null,
            'srp' => 40,
            'markup' => 15,
            'units_id' => 3,
        ],[

            'product_name' => 'Mango',
            'types_id' => 1,
            'product_description' => 'This is a Mango is succulent, meaty, sweet, nutritious and deliciously tempting.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/mango.jpg',
            'price' => null,
            'srp' => 150,
            'markup' => 15,
            'units_id' => 5,
        ],[

            'product_name' => 'Grapes',
            'types_id' => 1,
            'product_description' => 'Grapes are small round or oval berries that feature a semi-translucent flesh encased by a smooth skin',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/grapes.jpeg',
            'price' => null,
            'srp' => 200,
            'markup' => 15,
            'units_id' => 5,
        ],[

            'product_name' => 'Carrot',
            'types_id' => 2,
            'product_description' => 'This Vegetable  is rich in carotene, a precursor of Vitamin A. It also contains appreciable
            amounts of thiamine, riboflavin and sugar.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/carrot.jpg',
            'price' => null,
            'srp' => 70,
            'markup' => 15,
            'units_id' => 5 ,
        ],[

            'product_name' => 'Orange',
            'types_id' => 1,
            'product_description' => 'The orange is the fruit of the citrus species Citrus × sinensis in the family Rutaceae, native to China.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/orange.jpg',
            'price' => null,
            'srp' => 10,
            'markup' => 15,
            'units_id' => 1,
        ],[

            'product_name' => 'Okra',
            'types_id' => 2,
            'product_description' => 'Okra is an herbaceous annual plant in the family Malvaceae which is grown for its edible seed pods.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/okra.jpg',
            'price' => null,
            'srp' => 30,
            'markup' => 15,
            'units_id' => 3,
        ],[

            'product_name' => 'Onion',
            'types_id' => 2,
            'product_description' => 'The onion, also known as the bulb onion or common onion, is a vegetable that is the most widely cultivated species of the genus Allium.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/onion.jpg',
            'price' => null,
            'srp' => 100,
            'markup' => 15,
            'units_id' => 5,
        ],[

            'product_name' => 'Melon',
            'types_id' => 1,
            'product_description' => 'A melon is any of various plants of the family Cucurbitaceae with sweet edible, fleshy fruit.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/watermelon.jpg',
            'price' => null,
            'srp' => 60,
            'markup' => 15,
            'units_id' => 5,
        ],[

            'product_name' => 'Watermelon',
            'types_id' => 1,
            'product_description' => 'It has a high water content and also delivers many other important nutrients, including lycopene and vitamin C.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/watermelon.jpg',
            'price' => null,
            'srp' => 80,
            'markup' => 15,
            'units_id' => 5,
        ],[

            'product_name' => 'Guava',
            'types_id' => 1,
            'product_description' => 'Guava has a slender trunk with smooth green to red-brown bark.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/guava.png',
            'price' => null,
            'srp' => 10,
            'markup' => 15,
            'units_id' => 1,
        ],[

            'product_name' => 'Corn',
            'types_id' => 2,
            'product_description' => 'The corn plant possesses a simple stem of nodes and internodes.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/corn.jpg',
            'price' => null,
            'srp' => 100,
            'markup' => 15,
            'units_id' => 5,
        ],[

            'product_name' => 'Broccoli',
            'types_id' => 2,
            'product_description' => 'The broccoli plant has a thick green stalk, or stem, which gives rise to thick, leathery, oblong leaves which are gray-blue to green in color.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/bron.jpeg',
            'price' => null,
            'srp' => 150,
            'markup' => 15,
            'units_id' => 3,
        ],[

            'product_name' => 'Malunggay',
            'types_id' => 2,
            'product_description' => 'Malunggay is classified as a tropical plant that can reach a height of 9 meters.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/malunggay.jpg',
            'price' => null,
            'srp' => 30,
            'markup' => 15,
            'units_id' => 2,
        ],[

            'product_name' => 'Green Bean',
            'types_id' => 2,
            'product_description' => 'Green beans are the unripe, young fruit and protective pods of various cultivars of the common bean.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/greenbeans.jpg',
            'price' => null,
            'srp' => 200,
            'markup' => 15,
            'units_id' => 2,
        ],[

            'product_name' => 'Eggplant',
            'types_id' => 2,
            'product_description' => 'Eggplants are commonly purple, the spongy, absorbent fruit is used in various cuisines.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/eggplants.jpg',
            'price' => null,
            'srp' => 50,
            'markup' => 15,
            'units_id' => 2,
        ],[

            'product_name' => 'Scallion',
            'types_id' => 2,
            'product_description' => 'Scallions have a milder taste than most onions.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/scallion.jpg',
            'price' => null,
            'srp' => 30,
            'markup' => 15,
            'units_id' => 3,
        ],[

            'product_name' => 'Garlic',
            'types_id' => 2,
            'product_description' => 'Garlic is a species in the onion genus, Allium. Its close relatives include the onion, shallot, leek, chive, and Chinese onion.',
            'quantity' => 0,
            'photo' => 'https://storage.googleapis.com/eharvest-files/product/photos/garlic%20(1).jpg',
            'price' => null,
            'srp' => 100,
            'markup' => 15,
            'units_id' => 5,
        ]

        ]);
    }
}

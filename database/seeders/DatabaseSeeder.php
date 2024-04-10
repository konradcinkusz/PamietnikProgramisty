<?php

namespace Database\Seeders;

use App\Models\User; // Import the User model
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create three example users
        User::create([
            'name' => 'Konrad',
            'email' => 'konrad@example.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Joanna',
            'email' => 'joanna@example.com',
            'password' => bcrypt('securepass'),
        ]);

        User::create([
            'name' => 'Roza',
            'email' => 'roza@example.com',
            'password' => bcrypt('secret123'),
        ]);
        
        $categories = [
            [
                'name' => 'Umiejętności kognitywne',
                'color_code' => '#336699', // Choose your own color
            ],
            [
                'name' => 'Umiejętności programistyczne',
                'color_code' => '#993366', // Choose your own color
            ],
            [
                'name' => 'Umiejętności językowe',
                'color_code' => '#669933', // Choose your own color
            ],
            [
                'name' => 'Umiejętności techniczne',
                'color_code' => '#996633', // Choose your own color
            ],
            [
                'name' => 'Umiejętności artystyczne',
                'color_code' => '#993333', // Choose your own color
            ],
            [
                'name' => 'Umiejętności sportowe',
                'color_code' => '#339933', // Choose your own color
            ],
            [
                'name' => 'Umiejętności kulinarna',
                'color_code' => '#333399', // Choose your own color
            ],
            [
                'name' => 'Umiejętności interpersonalne',
                'color_code' => '#993399', // Choose your own color
            ],
            [
                'name' => 'Umiejętności zarządzania czasem',
                'color_code' => '#993333', // Choose your own color
            ],
            [
                'name' => 'Umiejętności edukacyjne',
                'color_code' => '#333366', // Choose your own color
            ],
        ];

        DB::table('categories')->insert($categories);
        
        // $events = [
        //     [
        //         'name' => 'Pierwsze słowa',
        //         'start_date' => '1991-01-04',
        //         'end_date' => '1993-01-04',
        //         'description' => 'Opis: W tym okresie, między 4 stycznia 1991 a 4 stycznia 1993, wypowiedziałem swoje pierwsze słowa, rozpoczynając proces nauki mówienia.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 1, 
        //     ],
        //     [
        //         'name' => 'Pierwszy krok',
        //         'start_date' => '1990-01-04',
        //         'end_date' => '1991-01-04',
        //         'description' => 'Opis: Około roku po moich narodzinach, między 4 stycznia 1990 a 4 stycznia 1991, postawiłem swoje pierwsze kroki, co było początkiem mojej nauki chodzenia.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 1,
        //     ],
        //     [
        //         'name' => 'Pierwszy rower',
        //         'start_date' => '1994-01-04',
        //         'end_date' => '1996-01-04',
        //         'description' => 'Opis: Między 4 stycznia 1994 a 4 stycznia 1996, nauczyłem się jeździć na rowerze, od pierwszych prób do pewnej jazdy.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 1,
        //     ],
        //     [
        //         'name' => 'Pierwsza książka',
        //         'start_date' => '1996-01-04',
        //         'end_date' => '1997-01-04',
        //         'description' => 'Opis: Między 4 stycznia 1996 a 4 stycznia 1997 przeczytałem swoją pierwszą książkę, co rozwinęło moją miłość do czytania.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 3,
        //     ],
        //     [
        //         'name' => 'Pierwszy komputer',
        //         'start_date' => '2000-01-04',
        //         'end_date' => '2002-01-04',
        //         'description' => 'Opis: Między 4 stycznia 2000 a 4 stycznia 2002 dostałem swój pierwszy komputer i zacząłem poznawać jego obsługę.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 4, // Umiejętności techniczne
        //     ],
        //     [
        //         'name' => 'Pierwszy program',
        //         'start_date' => '2005-01-04',
        //         'end_date' => '2007-01-04',
        //         'description' => 'Opis: Między 4 stycznia 2005 a 4 stycznia 2007 napisałem mój pierwszy prosty program, co otworzyło drzwi do świata kodowania.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 2, // Umiejętności programistyczne
        //     ],
        //     [
        //         'name' => 'Pierwszy projekt szkolny',
        //         'start_date' => '2007-01-04',
        //         'end_date' => '2009-01-04',
        //         'description' => 'Opis: Między 4 stycznia 2007 a 4 stycznia 2009 ukończyłem swój pierwszy projekt programistyczny w szkole.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 2, // Umiejętności programistyczne
        //     ],
        //     [
        //         'name' => 'Nauka nowego języka programowania',
        //         'start_date' => '2013-01-04',
        //         'end_date' => '2014-01-04',
        //         'description' => 'Opis: Między 4 stycznia 2013 a 4 stycznia 2014 nauczyłem się nowego języka programowania, co poszerzyło moje umiejętności programistyczne.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 2, // Umiejętności programistyczne
        //     ],
        //     [
        //         'name' => 'Pierwsze osiągnięcie w pracy',
        //         'start_date' => '2015-01-04',
        //         'end_date' => '2016-01-04',
        //         'description' => 'Opis: Między 4 stycznia 2015 a 4 stycznia 2016 otrzymałem nagrodę za wyjątkowe osiągnięcie w pracy.',
        //         'image_path' => null,
        //         'user_id' => 1,
        //         'category_id' => 8, // Umiejętności interpersonalne
        //     ],
        // ];

        // DB::table('events')->insert($events);
    }
}

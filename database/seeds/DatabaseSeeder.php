<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	foreach (range(1,5) as $index) {
	        DB::table('schools')->insert([
	            'brin' => $faker->name,
	            'naam' => $faker->name,
	            'adres' => $faker->numberBetween(1, 100),
	            'postcode' => $faker->numberBetween($min = 1000, $max = 9999) . $faker->randomLetter . $faker->randomLetter,
	            'plaatsnaam' => $faker->city,
	            'website' => $faker->domainName,
	            'bevoegd_gezag' => $faker->numberBetween(100000, 999999),

	            'aanbod_1' => $faker->numberBetween(0, 1),
	            'aanbod_2' => $faker->numberBetween(0, 1),
	            'aanbod_3' => $faker->numberBetween(0, 1),
	            'aanbod_4' => $faker->numberBetween(0, 1),
	            'aanbod_5' => $faker->numberBetween(0, 1),

	            //'vraag_1' => $faker->numberBetween(0, 1),
	            //'vraag_2' => $faker->numberBetween(0, 1),
	            //'vraag_3' => $faker->numberBetween(0, 1),
	            //'vraag_4' => $faker->numberBetween(0, 1),
	            //'vraag_5' => $faker->numberBetween(0, 1),

	            'meta_score_leerlingen' => $faker->numberBetween(1, 25),
				'meta_score_onderwijs' => $faker->numberBetween(1, 25),
				'meta_score_voorzieningen' => $faker->numberBetween(1, 25),
				'meta_score_afspraken' => $faker->numberBetween(1, 25),
				'meta_score_samenwerken' => $faker->numberBetween(1, 25),

	            'rd_x' => "134980",
	            'rd_y' => "461621",

	            'wgs84_x' => '52.142416', 
	            'wgs84_y' => '5.094751',

	            //'binaire_score_1' => $faker->numberBetween(0,1),
	            //'binaire_score_2' => $faker->numberBetween(0,1),
	            //'binaire_score_3' => $faker->numberBetween(0,1),
	            //'binaire_score_4' => $faker->numberBetween(0,1),
	            //'binaire_score_5' => $faker->numberBetween(0,1),

	            'created_at' => date("Y-m-d"),
	            'updated_at' => date("Y-m-d"),
	        ]);
        }
    }    
}

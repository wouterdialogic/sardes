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
    	foreach (range(1,10) as $index) {
	        DB::table('schools')->insert([
	            'brin' => $faker->name,
	            'naam' => $faker->name,
	            'adres' => $faker->address,
	            'postcode' => $faker->name,
	            'plaatsnaam' => $faker->city,
	            'website' => $faker->domainName,
	            'bevoegd_gezag' => $faker->numberBetween(100000, 999999),

	            'score_1' => $faker->numberBetween(1,100),
	            'score_2' => $faker->numberBetween(1,100),
	            'score_3' => $faker->numberBetween(1,100),
	            'score_4' => $faker->numberBetween(1,100),
	            'score_5' => $faker->numberBetween(1,100),
	            'binaire_score_1' => $faker->numberBetween(0,1),
	            'binaire_score_2' => $faker->numberBetween(0,1),
	            'binaire_score_3' => $faker->numberBetween(0,1),
	            'binaire_score_4' => $faker->numberBetween(0,1),
	            'binaire_score_5' => $faker->numberBetween(0,1),

	            'created_at' => date("Y-m-d"),
	            'updated_at' => date("Y-m-d"),
	        ]);
        }
    }    
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Tweet;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Create a Faker object
  		$faker = Faker\Factory::create();

  		foreach( range(1, 100) as $item )
  		{
  	        Tweet::create(array(
  		        'ownerUserId' => $faker->numberBetween($min = 1, $max = 10),
  		        'content' => $faker->realText(140),
  		        'likesCount' => $faker->numberBetween($min = 1, $max = 10),
  	        ));
  		}
    }
}

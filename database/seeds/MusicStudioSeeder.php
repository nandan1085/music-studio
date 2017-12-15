<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MusicStudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 70; $i++){
            $studio = new \App\Models\Studio();
            $name = $faker->company;
            $studio->name = $name;
            $studio->about = $faker->realText();
            $studio->image = $faker->imageUrl('100', '100');
            $studio->action_url = strtolower(str_replace(',', '', str_replace(' ', '-', $name)));
            $studio->address = $faker->address;
            $studio->website = $faker->url;
            $studio->opening_time = $faker->time();
            $studio->closing_time = $faker->time();
            $studio->save();
        }
    }
}

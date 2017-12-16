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
            $time = $faker->time();
            $diff = rand(5, 14);
            $start = \Carbon\Carbon::createFromDate('2017', '12', '16')->setTimeFromTimeString($time)->setTimezone('Asia/Kolkata');
            $end = \Carbon\Carbon::createFromDate('2017', '12', '16')->setTimeFromTimeString($faker->time())->addHours($diff)->setTimezone('Asia/Kolkata');
            $studio->opening_time = $start;
            $studio->closing_time = $end;
            $studio->save();
        }
    }
}

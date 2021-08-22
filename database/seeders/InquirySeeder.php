<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $inquiry = new Inquiry();
            $inquiry->first_name = $faker->firstName();
            $inquiry->last_name = $faker->lastName();
            $inquiry->company = $faker->company();
            $inquiry->email = $faker->email();
            $inquiry->phone = $faker->randomNumber(9, true);
            $inquiry->location = $faker->city . ", " . $faker->country();
            $inquiry->message = $faker->paragraph(3, false);
            $inquiry->active = rand(0, 1);
            $inquiry->save();
        }
    }
}

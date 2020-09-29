<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user){
            Rating::updateOrCreate([
                'user_id' => $user['id'],
                'rate_user_id' => random_int(1,10),
                'rate' => random_int(2,5)
            ]);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $sender = User::factory()->count(5)->create(['type' => '0']);
        $biker = User::factory()->count(10)->create(['type' => '1']);
    }
}

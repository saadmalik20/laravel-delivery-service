<?php

namespace Database\Seeders;

use App\Models\Parcel;
use Illuminate\Database\Seeder;

class ParcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parcel::truncate();
        $sender = Parcel::factory()->count(5)->create();
    }
}

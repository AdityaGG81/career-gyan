<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MassCareersExpansionSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MassCareersExpansionSeeder1::class,
            MassCareersExpansionSeeder2::class,
            MassCareersExpansionSeeder3::class,
        ]);
    }
}

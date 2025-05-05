<?php

namespace Database\Seeders;

use App\Models\WifiPackage;
use Illuminate\Database\Seeder;

class WifiPackageSeeder extends Seeder
{
    public function run(): void
    {
        WifiPackage::create([
            'name' => 'Paket 1',
            'price' => 100000,
            'speed' => '5Mbps',
        ]);

        WifiPackage::create([
            'name' => 'Paket 2',
            'price' => 170000,
            'speed' => '10Mbps',
        ]);
    }
}
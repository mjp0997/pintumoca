<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'bolívares', 'iso_code' => 'VED'],
            ['name' => 'dólares', 'iso_code' => 'USD'],
        ];
        
        foreach ($currencies as $currency) {
            Currency::firstOrCreate([
                'name' => $currency['name'],
            ]);
        }
    }
}

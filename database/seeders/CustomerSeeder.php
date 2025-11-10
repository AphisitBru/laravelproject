<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['cardID' => 'cus001', 'name' => 'Foke', 'tel' => '809519186', 'gen' => 'male'],
            ['cardID' => 'cus002', 'name' => 'Twor', 'tel' => '0123456789', 'gen' => 'male'],
            ['cardID' => 'cus003', 'name' => 'khuat', 'tel' => '0123456789', 'gen' => 'male'],
            ['cardID' => 'cus004', 'name' => 'fseff', 'tel' => '0123456789', 'gen' => 'male'],
            ['cardID' => 'cus005', 'name' => 'fsrsseff', 'tel' => '0123456789', 'gen' => 'male'],
        ];

        foreach ($customers as $customerData) {
            Customer::firstOrCreate(
                ['cardID' => $customerData['cardID']],
                $customerData
            );
        }
    }
}
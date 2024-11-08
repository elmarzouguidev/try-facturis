<?php

namespace Database\Seeders;

use App\Models\Facturis\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['name' => 'Starter',  'price' => 950,  'content' => 'Facturis Starter',],
            ['name' => 'Business', 'price' => 2350,  'content' => 'Facturis Business'],
            ['name' => 'Enterprise', 'price' => 4500, 'content' => 'Facturis Enterprise'],
        ];

        foreach ($plans as $plans) {
            Plan::create($plans);
        }
    }
}

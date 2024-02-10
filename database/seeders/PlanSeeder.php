<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Plan::factory(10)->create();

        \App\Models\Plan::factory()->create([
            'name'                  =>  'Basic',
            'price'                 =>  1000,
            'billing_cycle'         =>  'Monlty',
            'duration_in_months'    =>  1
        ]);

        \App\Models\Plan::factory()->create([
            'name'                  =>  'Standard',
            'price'                 =>  10000,
            'billing_cycle'         =>  'Yearly',
            'duration_in_months'    =>  12  
        ]);
    }
}

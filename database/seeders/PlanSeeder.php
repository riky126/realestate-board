<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Plan::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECK=0');

        DB::table('plans')->truncate();

        \App\Models\Plan::factory()->create([
            'name'                  =>  'Basic',
            'price'                 =>  1000,
            'billing_cycle'         =>  'Monlty',
            'duration_in_months'    =>  1,
            'discount'              =>  0.0
        ]);

        \App\Models\Plan::factory()->create([
            'name'                  =>  'Standard',
            'price'                 =>  10000,
            'billing_cycle'         =>  'Yearly',
            'duration_in_months'    =>  12,
            'discount'              =>  18.0
        ]);

        DB::statement('SET FOREIGN_KEY_CHECK=1');
    }
}

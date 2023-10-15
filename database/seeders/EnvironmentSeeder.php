<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $environments = [
            ['name' => 'LGWAN環境'],
            ['name' => '通常環境'],
        ];

        foreach ($environments as $environment) {
            DB::table('environments')->insert($environment);
        }
    }
}

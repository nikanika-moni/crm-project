<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            ['name' => '山本'],
            ['name' => '山田'],
            ['name' => '田中'],
            ['name' => '佐藤'],
        ];

        foreach ($members as $member) {
            DB::table('members')->insert($member);
        }
    }
}

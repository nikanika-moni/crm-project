<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['name' => '送信元専用番号登録'],
            ['name' => '長文SMSオプション'],
            ['name' => 'キャリア判別機能'],
            ['name' => '個人情報削除機能'],
            ['name' => '再送信機能'],
            ['name' => '一斉送信承認機能'],
            ['name' => '個別送信承認機能'],
            ['name' => '短縮ドメイン選択機能'],
            ['name' => 'キャリア蓄積再送設定'],
            ['name' => 'ファイルアップロード'],
            ['name' => '他人判定サービス'],
            ['name' => 'CSVフォーマット可変機能'],
            ['name' => 'キャリア番号共通化'],
            ['name' => '双方向サービス'],
        ];

        foreach ($options as $option) {
            DB::table('options')->insert($option);
        }
    }
}

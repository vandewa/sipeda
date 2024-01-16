<?php

namespace Database\Seeders;

use App\Models\Background;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('backgrounds')->truncate();

        $data = [
            [
                'path_bupati' => 'bupati.png',
            ],
            [
                'path_kadis' => 'Superadmin',
            ],
        ];

        foreach ($data as $datum) {
            $a = Background::create($datum);
        }
    }
}

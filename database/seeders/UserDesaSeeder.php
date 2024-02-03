<?php

namespace Database\Seeders;

use App\Models\ComRegion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data = ComRegion::with(['root'])->where('region_level', 4)->get();
        // foreach($data as $item){
        //     if($item->root->region_cd??"" != ""){
        //         $a = User::create([
        //             'name'=> 'Admin Desa '. $item->region_nm,
        //             'region_kel' => $item->region_cd,
        //             'region_kec' => $item->root->region_cd,
        //             'email' => strtolower($item->region_nm."-".$item->root->region_nm."@app.com"),
        //             'password' => Hash::make('password')
        //         ]);
        //         $a->addRole('desa');
        //     }
        // }
        $data = ComRegion::with(['root'])->where('region_level', 3)->get();
        foreach($data as $item){
            User::where('email', strtolower('admin'.'@'.$item->region_nm."id"))->update([
                'email' => strtolower('admin'.'@'.$item->region_nm.".id")
            ]);
            // $a = User::create([
            //     'name'=> 'Admin Desa '. $item->region_nm,
            //     'region_kec' => $item->region_cd,
            //     'email' => strtolower('admin'.'@'.$item->region_nm."id"),
            //     'password' => Hash::make('password')
            // ]);
            // $a->addRole('kecamatan');
        }
    }

}

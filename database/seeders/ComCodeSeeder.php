<?php

namespace Database\Seeders;

use App\Models\ComCode as Code;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('com_codes')->truncate();
        $code = Code::create(["com_cd" => "PENGAJUAN_TP_01", "code_nm" => "Disetujui", "code_group" => "PENGAJUAN_TP"]);
        $code = Code::create(["com_cd" => "PENGAJUAN_TP_02", "code_nm" => "Ditolak", "code_group" => "PENGAJUAN_TP"]);
        $code = Code::create(["com_cd" => "STATUS_TP_01", "code_nm" => "Menunggu Respon", "code_group" => "STATUS_TP"]);
        $code = Code::create(["com_cd" => "STATUS_TP_02", "code_nm" => "Perbaikan", "code_group" => "STATUS_TP"]);
        $code = Code::create(["com_cd" => "STATUS_TP_00", "code_nm" => "DRAFT", "code_group" => "STATUS_TP"]);
        $code = Code::create(["com_cd" => "POSISI_ST_01", "code_nm" => "Desa", "code_group" => "POSISI_ST"]);
        $code = Code::create(["com_cd" => "POSISI_ST_02", "code_nm" => "Kecamatan", "code_group" => "POSISI_ST"]);
        $code = Code::create(["com_cd" => "POSISI_ST_03", "code_nm" => "DINSOSPMD", "code_group" => "POSISI_ST"]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PangajuanSyarat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function dokumen() {
        return $this->belongsTo(PengumpulanSyarat::class, 'pengumpulan_syarat_id');
    }
    public function pengajuan()  {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');

    }

    public function history() {
        return $this->hasMany(PengajuanSyaratHistory::class, 'pangajuan_syarat_id');
    }

}

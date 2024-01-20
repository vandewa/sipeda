<?php

namespace App\Models;

use App\Models\PangajuanSyarat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeCari($query, $s)
    {
        if ($s) {
            return $query->where('judul', 'LIKE', '%' . $s . '%');
        }
    }

    public function status()
    {
        return $this->hasMany(StatusPengajuan::class, 'pengajuan_id')->orderBy('created_at', 'desc');
    }

    public function statusTerbaru()
    {
        return $this->hasOne(StatusPengajuan::class, 'pengajuan_id')->orderBy('created_at', 'desc')->orderBy('id', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengumpulan()
    {
        return $this->belongsTo(Pengumpulan::class, 'pengumpulan_id');
    }

    public function persyaratan()
    {
        return $this->hasMany(PangajuanSyarat::class, 'pengajuan_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(ComRegion::class, 'region_kec');
    }

    public function desa()
    {
        return $this->belongsTo(ComRegion::class, 'region_kel');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengajuan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pengajuannya()
    {
        return $this->belongsTo(ComCode::class, 'pengajuan_tp');
    }

    public function posisinya()
    {
        return $this->belongsTo(ComCode::class, 'posisi_st');
    }

    public function statusnya()
    {
        return $this->belongsTo(ComCode::class, 'status_tp');
    }

    public function usernya()
    {
        return $this->belongsTo(User::class, 'oleh');
    }

}


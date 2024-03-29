<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function syarat()
    {
        return $this->hasMany(PengumpulanSyarat::class, 'pengumpulan_id');
    }
}

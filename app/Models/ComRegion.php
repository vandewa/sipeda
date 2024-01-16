<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComRegion extends Model
{
    use HasFactory;

    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = "region_cd";
    protected $guarded = [];
    public $incrementing = false;

    public function root()
    {
        return $this->belongsTo(ComRegion::class, 'region_root');
    }

    public function scopeCari($filter, $value)
    {
        if ($value) {
            return $this->where('region_nm', 'like', "%$value%");
        }

    }
}

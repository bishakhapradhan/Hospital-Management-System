<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;
    public function staff(){
        return $this->belongsTo(staff::class,'staff_id');
    }
}

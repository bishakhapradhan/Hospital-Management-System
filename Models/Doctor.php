<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public function specialist(){
        return $this->belongsTo(Specialist::class,'specialist_id');
    }
    protected $append=['image_path'];
    public function getImagePathAttribute()
    {
        if(!empty($this->image))
        return asset('uploads/user/' .$this->image);
        return null;
    }
}

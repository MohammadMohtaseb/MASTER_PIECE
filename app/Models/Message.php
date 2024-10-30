<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parent()
    {
            if(Auth::guard('parent')->check())
            {
                return $this->belongsTo(ParentStudent::class,'sender');
            }else{
                return $this->belongsTo(ParentStudent::class,'receiver');
            }
    }

    public function teacher()
    {
        if(Auth::guard('parent')->check())
        {
            return $this->belongsTo(Teacher::class,'sender');

        }else{
            return $this->belongsTo(Teacher::class,'receiver');

        }
    }
}

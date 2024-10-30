<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Filemanger extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'title', 'descrption', 'file','file_size'];

    // Optionally, you can add a method to get the full URL of the file
    public function getFileUrlAttribute()
    {
        return Storage::url($this->file);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class,'chapter_id');
    }
}

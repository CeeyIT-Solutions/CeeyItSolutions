<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'full_name',
        'email',
        'phone',
        'course_id',
        'approval_status',
        'reason'
    ];

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}

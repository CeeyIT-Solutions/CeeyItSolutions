<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'occupation',
        'interest',
        'challenges',
        'course',
        'course_id',
        'tech_experience',
        'tech_experience_details',
        'goals',
        'terms',
        'apply_year',
        'approval_status',
        'slack_invite_status',
        'is_slack_invite_sent',
        'is_email_sent'
    ];

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'ver_code_send_at' => 'datetime',
        'instructor_info' => 'object',
    ];

    protected $data = [
        'data'=>1
    ];


    public function login_logs()
    {
        return $this->hasMany(UserLogin::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class,'author_id')->where('status',1);
    }

    public function userCourses()
    {
        return $this->belongsToMany(Course::class, 'user_courses','user_id')->where('user_courses.status',"success");
    }


    public function courseUsers()
    {
        return $this->hasMany(UserCourse::class, 'user_id');
    }



    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id','desc');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status','!=',0);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class)->where('status','!=',0);
    }

    public function totalEnrolled()
    {
        return $this->hasMany(UserCourse::class,'author_id');
    }
    public function totalReview()
    {
        return $this->hasMany(Review::class,'author_id');
    }

   
    



    // SCOPES

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    public function reviewed($courseId)
    {
        return Review::where([['user_id',auth()->id()],['course_id',$courseId]])->exists();
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeBanned()
    {
        return $this->where('status', 0);
    }

    public function scopeEmailUnverified()
    {
        return $this->where('ev', 0);
    }

    public function scopeSmsUnverified()
    {
        return $this->where('sv', 0);
    }
    public function scopeEmailVerified()
    {
        return $this->where('ev', 1);
    }

    public function scopeSmsVerified()
    {
        return $this->where('sv', 1);
    }



}

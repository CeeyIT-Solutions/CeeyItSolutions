<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table =  "courses";
    protected $casts = [
        'tags' => 'object'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id')->withDefault();
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id')->withDefault();
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'course_id')->whereNull('parent_id');
    }
    public function chapter()
    {
        return $this->hasMany(Chapter::class, 'course_id');
    }
    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'course_id');
    }

    public function usersCourse()
    {
        return $this->hasMany(UserCourse::class, 'course_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id');
    }

    public function courseUsers()
    {
        return $this->belongsToMany(User::class, 'user_courses', 'course_id');
    }


    public function scopeBanned()
    {
        return $this->where('status', 2);
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeInactive()
    {
        return $this->where('status', 0);
    }

    public function scopeFilters()
    {
        $type  = request('type');
        $value = request('value');
        $search = request('search');
        $cat   = Category::where('slug', request('category'))->first();
        $level = Level::where('slug', request('level'))->first();

        return $this->where('status', 1)->when($type == 1, function ($q) {
            return $q->where('is_top', 1);
        })
            ->when($search, function ($q, $search) {
                return $q->where('title', 'like', "%$search%")->orWhereJsonContains('tags', $search);
            })
            ->when($value == 'free', function ($q) {
                return $q->where('value', 0);
            })
            ->when($value == 'premium', function ($q) {
                return $q->where('value', 1);
            })
            ->when($cat, function ($q, $cat) {
                return $q->where('category_id', $cat->id);
            })

            ->when($level, function ($q, $level) {
                return $q->where('level_id', $level->id);
            })
            ->when($type == 2, function ($q) {
                return $q->orderBy('created_at', 'desc');
            })->with(['author', 'category', 'level', 'subcategory', 'courseUsers']);
    }

    public function scopeEagerLoads()
    {
        return $this->with(['subcategory', 'author', 'category', 'courseUsers', 'chapter', 'lectures', 'reviews', 'comments'])->withCount(['chapter', 'lectures', 'reviews', 'comments']);
    }

    public function scopeTopCourse()
    {
        return $this->where('is_top', 1);
    }

    public function scopeLatestCourses()
    {
        return $this->active()->eagerLoads()->latest()->take(6)->get();
    }
    public function scopeTopCourses()
    {
        return $this->active()->topCourse()->with(['subcategory', 'author', 'category'])->withCount(['chapter', 'lectures'])->latest()->take(6)->get();
    }


    public function scopeAvgRating()
    {
        $totalCount = $this->reviews->count('stars');
        $sum = $this->reviews->sum('stars');
        if ($totalCount == 0) {
            return 0;
        }
        return $sum / $totalCount;
    }
    public function starCount($star)
    {
        $count = $this->reviews->where('stars', $star)->count();
        $totalCount = $this->reviews->count();
        if ($totalCount == 0) {
            return 0;
        }
        return (100 * $count) / $totalCount;
    }

    public function discountPrice()
    {
        $discount = $this->price * ($this->discount / 100);
        $finalPrice = $this->price - $discount;
        return $finalPrice;
    }
    public function totalDuration()
    {
        return getAmount($this->lectures()->sum('duration') / 60, 1);
    }
}

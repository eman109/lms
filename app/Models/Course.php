<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = ['instructor_id', 'title', 'description', 'published'];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function lessons():HasMany
    {
        return $this->hasMany(Lesson::class);
    }
    public function students():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')->withTimestamps();

    }
}

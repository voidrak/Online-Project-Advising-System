<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'project_title',
        'description',
        'student_id',
        'advisor_id',
        'department',
        'document',
        'due_date',
        'approved',
        'completed'
    ];


    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}

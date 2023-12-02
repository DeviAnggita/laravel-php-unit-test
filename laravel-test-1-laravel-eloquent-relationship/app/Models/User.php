<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'users_id', 'id');
    }

    // TASK: Define the two-level relationship in the User model
    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Task::class, 'users_id', 'task_id', 'id', 'id');
    }

    // public function projects()
    // {
    //     return $this->belongsToMany(Project::class)->withPivot('start_date');
    // }

    // User.php Model

public function projects()
{
    return $this->belongsToMany(Project::class, 'project_user')->withPivot('start_date');
}

}
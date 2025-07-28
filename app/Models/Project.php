<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'deadline',
        'user_id',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function getProgressAttribute()
    {
        $total = $this->tasks()->count();
        $completed = $this->tasks()->where('is_completed', true)->count();

        if ($total === 0) return 0;

        return round(($completed / $total) * 100);
    }
}

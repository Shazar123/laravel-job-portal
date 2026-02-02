<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'resume',
        'cover_letter',
        'status'
    ];

    // Relationship: An application belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: An application belongs to a job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // 👇 IMPORTANT: custom table name
    protected $table = 'job_listings';

    protected $fillable = [
        'title',
        'description',
        'company',
        'location',
        'salary',
        'status'
    ];

    // A job can have many applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}

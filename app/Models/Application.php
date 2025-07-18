<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
     use HasFactory;
    protected $fillable = ['job_id', 'user_id', 'cover_letter', 'cv_path','status'];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function job()
{
    return $this->belongsTo(Job::class);
}

}

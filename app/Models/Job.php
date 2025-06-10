<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Application;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
    {
         use HasFactory;
        protected $table = 'job_listings';
        protected $fillable = [
            'title', 'description', 'location', 'contract_type', 'salary','is_approved'
        ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

}

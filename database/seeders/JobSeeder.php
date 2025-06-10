<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        if ($users->count() === 0) {
            $users = \App\Models\User::factory()->count(10)->create();
        }
        foreach ($users as $user) {
            \App\Models\Job::factory()->count(2)->create(['user_id' => $user->id]);
        }
    }
}

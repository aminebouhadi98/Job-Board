<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;

class TeamSeeder extends Seeder
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
            $team = \App\Models\Team::factory()->create(['user_id' => $user->id]);
            $user->current_team_id = $team->id;
            $user->save();
        }
    }
}

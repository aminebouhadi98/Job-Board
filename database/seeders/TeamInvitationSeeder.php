<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamInvitation;
use App\Models\Team;
use Illuminate\Support\Str;

class TeamInvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For each team, create a fake invitation
        $teams = Team::all();
        foreach ($teams as $team) {
            TeamInvitation::create([
                'team_id' => $team->id,
                'email' => Str::random(8) . '@example.com',
                'role' => 'member',
            ]);
        }
    }
}

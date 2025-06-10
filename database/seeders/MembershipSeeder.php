<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For each team, add 2-3 random users as members (besides the owner)
        $teams = Team::all();
        $userIds = User::pluck('id')->toArray();

        foreach ($teams as $team) {
            $members = Arr::random($userIds, min(3, count($userIds)));
            foreach ($members as $userId) {
                if ($userId !== $team->user_id) {
                    DB::table('team_user')->updateOrInsert([
                        'team_id' => $team->id,
                        'user_id' => $userId,
                    ], [
                        'role' => 'member',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}

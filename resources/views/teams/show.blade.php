<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-200 via-slate-100 to-blue-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight animate-fade-in">
                {{ __('Team Settings') }}
            </h2>
        </x-slot>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 animate-fade-in">
                @livewire('teams.update-team-name-form', ['team' => $team])
                @livewire('teams.team-member-manager', ['team' => $team])
                @if (Gate::check('delete', $team) && ! $team->personal_team)
                    <x-section-border />
                    <div class="mt-10 sm:mt-0">
                        @livewire('teams.delete-team-form', ['team' => $team])
                    </div>
                @endif
            </div>
        </div>
        <style>
            .animate-fade-in { animation: fadeIn 0.7s ease; }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: none; } }
        </style>
    </div>
</x-app-layout>

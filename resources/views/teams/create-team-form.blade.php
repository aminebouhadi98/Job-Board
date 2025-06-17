<div class="min-h-screen bg-gradient-to-br from-blue-200 via-slate-100 to-blue-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
    <x-form-section submit="createTeam">
        <x-slot name="title">
            <span class="text-2xl font-bold text-gray-900 dark:text-white animate-fade-in">{{ __('Team Details') }}</span>
        </x-slot>
        <x-slot name="description">
            <span class="text-gray-600 dark:text-gray-300 animate-fade-in">{{ __('Create a new team to collaborate with others on projects.') }}</span>
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6">
                <x-label value="{{ __('Team Owner') }}" class="text-gray-800 dark:text-gray-200" />
                <div class="flex items-center mt-2">
                    <img class="size-12 rounded-full object-cover border-2 border-blue-400 shadow-md" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">
                    <div class="ms-4 leading-tight">
                        <div class="text-gray-900 dark:text-white font-semibold">{{ $this->user->name }}</div>
                        <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $this->user->email }}</div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Team Name') }}" class="text-gray-800 dark:text-gray-200" />
                <x-input id="name" type="text" class="mt-1 block w-full dark:bg-gray-900 dark:text-white border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" wire:model="state.name" autofocus />
                <x-input-error for="name" class="mt-2" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-button class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white shadow-lg animate-bounce-in">
                {{ __('Create') }}
            </x-button>
        </x-slot>
        <style>
            .animate-fade-in { animation: fadeIn 0.7s ease; }
            .animate-bounce-in { animation: bounceIn 0.7s cubic-bezier(.68,-0.55,.27,1.55); }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: none; } }
            @keyframes bounceIn { 0% { opacity: 0; transform: scale(0.8);} 60% { opacity: 1; transform: scale(1.05);} 100% { transform: scale(1); } }
        </style>
    </x-form-section>
</div>

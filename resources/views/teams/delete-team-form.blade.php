<div class="min-h-screen bg-gradient-to-br from-blue-200 via-slate-100 to-blue-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
    <x-action-section>
        <x-slot name="title">
            <span class="text-2xl font-bold text-red-700 dark:text-red-400 animate-fade-in">{{ __('Delete Team') }}</span>
        </x-slot>
        <x-slot name="description">
            <span class="text-gray-600 dark:text-gray-300 animate-fade-in">{{ __('Permanently delete this team.') }}</span>
        </x-slot>
        <x-slot name="content">
            <div class="max-w-xl text-sm text-gray-600 dark:text-gray-300">
                {{ __('Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain.') }}
            </div>
            <div class="mt-5">
                <x-danger-button class="animate-bounce-in" wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    {{ __('Delete Team') }}
                </x-danger-button>
            </div>
            <!-- Delete Team Confirmation Modal -->
            <x-confirmation-modal wire:model.live="confirmingTeamDeletion">
                <x-slot name="title">
                    <span class="text-red-700 dark:text-red-400">{{ __('Delete Team') }}</span>
                </x-slot>
                <x-slot name="content">
                    <span class="text-gray-700 dark:text-gray-200">{{ __('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.') }}</span>
                </x-slot>
                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-danger-button class="ms-3 animate-bounce-in" wire:click="deleteTeam" wire:loading.attr="disabled">
                        {{ __('Delete Team') }}
                    </x-danger-button>
                </x-slot>
            </x-confirmation-modal>
        </x-slot>
        <style>
            .animate-fade-in { animation: fadeIn 0.7s ease; }
            .animate-bounce-in { animation: bounceIn 0.7s cubic-bezier(.68,-0.55,.27,1.55); }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: none; } }
            @keyframes bounceIn { 0% { opacity: 0; transform: scale(0.8);} 60% { opacity: 1; transform: scale(1.05);} 100% { transform: scale(1); } }
        </style>
    </x-action-section>
</div>

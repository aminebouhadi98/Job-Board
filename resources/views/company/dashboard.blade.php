<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500 flex items-center justify-center">
        <div class="max-w-2xl w-full mx-auto p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl animate-fade-in">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-4">Dashboard Azienda</h1>
            <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">Benvenuto, <span class="font-semibold">{{ auth()->user()->name }}</span>!</p>
            <div class="flex justify-center">
                <a href="{{ route('company.jobs.index') }}"
                   class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-6 py-3 rounded-xl shadow-lg font-semibold transition-all duration-200 focus:ring-2 focus:ring-blue-400 animate-bounce-in">
                    Gestisci annunci di lavoro
                </a>
            </div>
        </div>
        <style>
            .animate-fade-in { transition: opacity 0.7s; }
            .opacity-0 { opacity: 0; }
            .animate-bounce-in { animation: bounce-in 0.7s; }
            @keyframes bounce-in {
                0% { transform: scale(0.9); opacity: 0; }
                60% { transform: scale(1.05); opacity: 1; }
                100% { transform: scale(1); }
            }
        </style>
    </div>
</x-app-layout>

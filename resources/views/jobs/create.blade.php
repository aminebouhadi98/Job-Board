<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-200 via-slate-100 to-blue-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
        <div class="max-w-4xl mx-auto py-10 px-4">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8 animate-fade-in">Crea nuovo annuncio</h1>
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8 animate-fade-in">
                <form action="{{ route('company.jobs.store') }}" method="POST" class="space-y-6">
                    @include('jobs.form', ['buttonText' => 'Crea annuncio'])
                </form>
            </div>
        </div>
        <style>
            .animate-fade-in { animation: fadeIn 0.7s ease; }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: none; } }
        </style>
    </div>
</x-app-layout>

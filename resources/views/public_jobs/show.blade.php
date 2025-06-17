<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
        <div class="max-w-3xl mx-auto py-10 px-4 animate-fade-in">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $job->title }}</h1>
                <div class="flex flex-wrap gap-4 mb-4 text-gray-600 dark:text-gray-300 text-sm">
                    <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200 rounded">{{ $job->contract_type }}</span>
                    <span class="inline-block">{{ $job->location }}</span>
                    @if ($job->salary)
                        <span class="inline-block text-green-700 dark:text-green-300 font-semibold">RAL: €{{ number_format($job->salary, 0, ',', '.') }}</span>
                    @endif
                </div>
                <div class="prose max-w-none text-gray-800 dark:text-gray-200 mb-6">
                    {{ $job->description }}
                </div>
            </div>
            @if (auth()->user()?->role === 'candidate')
                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl shadow p-8 mb-8 animate-fade-in">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Candidati a questo annuncio</h2>
                    @if (session('success'))
                        <p class="text-green-600 mb-4 animate-fade-in">{{ session('success') }}</p>
                    @endif
                    <form method="POST" action="{{ route('jobs.apply', $job) }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <textarea name="cover_letter" rows="5" placeholder="Lettera di presentazione" class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition dark:bg-gray-800 dark:text-white" required>{{ old('cover_letter') }}</textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-6 py-2 rounded-lg shadow font-semibold transition-all duration-200 focus:ring-2 focus:ring-blue-400 animate-bounce-in">Invia candidatura</button>
                        </div>
                    </form>
                </div>
            @endif
            <div class="mt-8">
                <a href="{{ route('public.jobs.index') }}" class="text-blue-600 dark:text-blue-300 hover:underline">&larr; Torna alle offerte</a>
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

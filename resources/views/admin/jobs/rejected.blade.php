<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-200 via-slate-100 to-blue-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
        <div class="max-w-5xl mx-auto py-10 px-4">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8 text-center animate-fade-in">Annunci
                rifiutati
            </h1>
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('admin.jobs.index') }}"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2 rounded-lg shadow font-semibold flex items-center gap-2 animate-bounce-in">
                    Lista annunci
                </a>
            </div>
            @if (session('reapprove_success'))
                <p class="text-green-600 dark:text-green-400 mb-4 animate-fade-in">{{ session('reapprove_success') }}</p>
            @endif
            @if ($rejectedJobs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-fade-in">
                    @foreach ($rejectedJobs as $job)
                        <div
                            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl hover:scale-105 hover:shadow-2xl transition-all duration-300 p-6 flex flex-col justify-between animate-fade-in">
                            <div>
                                <h2 class="text-xl font-bold text-blue-700 dark:text-blue-300 mb-2">{{ $job->title }}</h2>
                                <div class="flex flex-wrap gap-2 mb-2 text-gray-600 dark:text-gray-300 text-sm">
                                    <span
                                        class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200 rounded">
                                        {{ $job->contract_type }}</span>
                                    <span class="inline-block">{{ $job->location }}</span>
                                    @if ($job->salary)
                                        <span
                                            class="inline-block text-green-700 dark:text-green-300 font-semibold">RAL:
                                            €{{ number_format($job->salary, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <p class="text-gray-700 dark:text-gray-200 line-clamp-3 mb-4">{{ Str::limit($job->description, 120)
                                    }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.jobs.reapprove', $job) }}"
                                class="mt-2 flex gap-3 justify-end">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow font-semibold transition-all duration-200 focus:ring-2 focus:ring-green-400 animate-bounce-in">
                                    Riattiva
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-20 animate-fade-in">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Nessun annuncio in attesa di approvazione.</p>
                </div>
            @endif
            <style>
                .animate-fade-in {
                    animation: fadeIn 0.7s ease;
                }

                .animate-bounce-in {
                    animation: bounceIn 0.7s cubic-bezier(.68, -0.55, .27, 1.55);
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }

                    to {
                        opacity: 1;
                        transform: none;
                    }
                }

                @keyframes bounceIn {
                    0% {
                        opacity: 0;
                        transform: scale(0.8);
                    }

                    60% {
                        opacity: 1;
                        transform: scale(1.05);
                    }

                    100% {
                        transform: scale(1);
                    }
                }
            </style>
        </div>
    </div>
</x-app-layout>

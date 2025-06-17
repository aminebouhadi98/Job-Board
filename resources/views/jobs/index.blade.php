<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-200 via-slate-100 to-blue-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
        <div class="max-w-7xl mx-auto py-10 px-4">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white drop-shadow-lg animate-fade-in">I tuoi
                    annunci</h2>
                <a href="{{ route('company.jobs.create') }}"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition text-white px-6 py-2 rounded-lg shadow-lg font-semibold flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-blue-400 animate-bounce-in">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuovo annuncio
                </a>
            </div>

            @if ($jobs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($jobs as $job)
                        <div
                            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl hover:scale-105 hover:shadow-2xl transition-all duration-300 p-6 flex flex-col justify-between animate-fade-in">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-1">{{ $job->title }}</h3>
                                <p class="text-gray-500 dark:text-gray-300 text-sm mb-2 flex items-center gap-2">
                                    <span>{{ $job->location }}</span> <span class="mx-1">|</span>
                                    <span
                                        class="inline-block px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-700 dark:text-blue-200 rounded text-xs">{{ $job->contract_type }}</span>
                                </p>
                                @if ($job->salary)
                                    <p class="text-green-700 dark:text-green-400 font-semibold">RAL:
                                        €{{ number_format($job->salary, 0, ',', '.') }}</p>
                                @endif
                            </div>
                            <a href="{{ route('company.jobs.applications.index', $job) }}"
                                class="text-blue-600 dark:text-blue-400 underline mt-2 hover:text-blue-800 dark:hover:text-blue-300 transition">Vedi
                                candidature</a>
                            <div class="flex gap-3 mt-6">
                                <a href="{{ route('company.jobs.edit', $job) }}"
                                    class="text-blue-600 dark:text-blue-400 hover:underline font-medium transition">Modifica</a>
                                <form action="{{ route('company.jobs.destroy', $job) }}" method="POST"
                                    onsubmit="return confirm('Sei sicuro di voler eliminare questo annuncio?')">
                                    @csrf @method('DELETE')
                                    <button
                                        class="text-red-600 dark:text-red-400 hover:underline font-medium transition">Elimina</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">{{ $jobs->links() }}</div>
            @else
                <div
                    class="text-center text-gray-500 dark:text-gray-300 py-20 text-lg animate-fade-in">Nessun annuncio
                    trovato.</div>
            @endif
        </div>
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
</x-app-layout>

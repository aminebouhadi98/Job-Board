<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-200 via-slate-100 to-blue-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
        <div class="max-w-6xl mx-auto py-12 px-4">
            <h1 class="text-4xl font-extrabold text-center mb-10 text-gray-900 dark:text-white animate-fade-in">Offerte di lavoro</h1>
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
                <form method="GET" action="{{ route('public.jobs.index') }}" class="flex flex-wrap gap-3 w-full md:w-auto justify-center animate-fade-in">
                    <input type="text" name="title" placeholder="Posizione" value="{{ request('title') }}" class="rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200 w-40 dark:bg-gray-800 dark:text-white" />
                    <input type="text" name="location" placeholder="Città" value="{{ request('location') }}" class="rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200 w-40 dark:bg-gray-800 dark:text-white" />
                    <select name="contract_type" class="rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200 w-40 dark:bg-gray-800 dark:text-white">
                        <option value="">Tipo contratto</option>
                        <option value="full-time" @selected(request('contract_type') == 'full-time')>Tempo pieno</option>
                        <option value="part-time" @selected(request('contract_type') == 'part-time')>Part-time</option>
                        <option value="temporary" @selected(request('contract_type') == 'temporary')>Temporaneo</option>
                        <option value="contract" @selected(request('contract_type') == 'contract')>Contratto</option>
                        <option value="stage" @selected(request('contract_type') == 'stage')>Stage / Tirocinio</option>
                    </select>
                    <input type="number" name="salary_min" placeholder="RAL minima" value="{{ request('salary_min') }}" class="rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200 w-32 dark:bg-gray-800 dark:text-white" />
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-6 py-2 rounded-xl shadow-lg font-semibold transition-all duration-200 focus:ring-2 focus:ring-blue-400 animate-bounce-in">Cerca</button>
                </form>
            </div>
            @if($jobs->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
                    @foreach ($jobs as $job)
                        <div class="relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl hover:scale-[1.03] transition-all duration-300 p-0 group animate-fade-in">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 via-white/80 to-blue-200/60 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 z-0"></div>
                            <div class="relative z-10 p-6 flex flex-col justify-between h-full">
                                <div>
                                    <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-300 mb-2 group-hover:underline transition-all duration-200 flex items-center gap-2">
                                        <svg class="w-6 h-6 text-blue-400 dark:text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                        {{ $job->title }}
                                    </h2>
                                    <div class="flex flex-wrap gap-2 mb-2 text-gray-600 dark:text-gray-300 text-sm">
                                        <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200 rounded">{{ $job->contract_type }}</span>
                                        <span class="inline-block">{{ $job->location }}</span>
                                        @if($job->salary)
                                            <span class="inline-block text-green-700 dark:text-green-300 font-semibold">RAL: €{{ number_format($job->salary, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <p class="text-gray-800 dark:text-gray-200 line-clamp-3">{{ Str::limit($job->description, 120) }}</p>
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <a href="{{ route('public.jobs.show', $job) }}" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-5 py-2 rounded-xl shadow-lg font-semibold transition-all duration-200 focus:ring-2 focus:ring-blue-400 animate-fade-in">Dettagli</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-10 flex justify-center animate-fade-in">
                    {{ $jobs->links() }}
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-20 animate-fade-in">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Nessun annuncio disponibile al momento.</p>
                </div>
            @endif
        </div>
        <script>
            document.querySelectorAll('.animate-fade-in').forEach(el => {
                el.classList.add('opacity-0');
                setTimeout(() => el.classList.remove('opacity-0'), 100);
            });
        </script>
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

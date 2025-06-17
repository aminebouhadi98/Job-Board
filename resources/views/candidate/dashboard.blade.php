<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-200 via-slate-100 to-blue-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
        <div class="max-w-5xl mx-auto py-10 px-4">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white drop-shadow-lg animate-fade-in">Le tue candidature</h1>
                <a href="{{ route('public.jobs.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition text-white px-6 py-2 rounded-lg shadow-lg font-semibold focus:outline-none focus:ring-2 focus:ring-blue-400 animate-bounce-in">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-3A2.25 2.25 0 008.25 5.25V9m7.5 0v10.5A2.25 2.25 0 0113.5 21h-3a2.25 2.25 0 01-2.25-2.25V9m7.5 0h-10.5" />
                    </svg>
                    Vai alle offerte di lavoro
                </a>
            </div>

            @php
                $applications = auth()->user()->applications()->with('job')->latest()->get();
            @endphp

            @if($applications->count())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($applications as $application)
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl hover:scale-105 hover:shadow-2xl transition-all duration-300 p-6 flex flex-col justify-between animate-fade-in">
                            <div>
                                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-1">{{ $application->job->title ?? 'Annuncio eliminato' }}</h2>
                                @if($application->job)
                                    <p class="text-gray-500 dark:text-gray-300 text-sm mb-2 flex items-center gap-2">{{ $application->job->location }} <span class="mx-1">|</span> <span class="inline-block px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-700 dark:text-blue-200 rounded text-xs">{{ $application->job->contract_type }}</span></p>
                                @endif
                                <p class="mt-2 font-semibold text-gray-700 dark:text-gray-200">Lettera inviata:</p>
                                <p class="text-gray-800 dark:text-gray-100 whitespace-pre-wrap">{{ $application->cover_letter }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500 dark:text-gray-300 py-20 text-lg animate-fade-in">Non hai ancora inviato nessuna candidatura.</div>
            @endif
        </div>
        <style>
            .animate-fade-in { animation: fadeIn 0.7s ease; }
            .animate-bounce-in { animation: bounceIn 0.7s cubic-bezier(.68,-0.55,.27,1.55); }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: none; } }
            @keyframes bounceIn { 0% { opacity: 0; transform: scale(0.8);} 60% { opacity: 1; transform: scale(1.05);} 100% { transform: scale(1); } }
        </style>
    </div>
</x-app-layout>

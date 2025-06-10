<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Le tue candidature</h1>
            <a href="{{ route('public.jobs.index') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded-lg shadow font-semibold">
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($applications as $application)
                    <div class="bg-white border border-gray-200 rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800 mb-1">{{ $application->job->title ?? 'Annuncio eliminato' }}</h2>
                            @if($application->job)
                                <p class="text-gray-500 text-sm mb-2">{{ $application->job->location }} <span class="mx-1">|</span> <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">{{ $application->job->contract_type }}</span></p>
                            @endif
                            <p class="mt-2 font-semibold text-gray-700">Lettera inviata:</p>
                            <p class="text-gray-800 whitespace-pre-wrap">{{ $application->cover_letter }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 py-20 text-lg">Non hai ancora inviato nessuna candidatura.</div>
        @endif
    </div>
</x-app-layout>

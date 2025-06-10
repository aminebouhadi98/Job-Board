<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4">
        <form method="GET" action="{{ route('public.jobs.index') }}" class="mb-6 space-y-2">
            <input type="text" name="location" placeholder="Location" value="{{ request('location') }}"
                class="border rounded px-2 py-1 w-full">

            <select name="contract_type" class="border rounded px-2 py-1 w-full">
                <option value="">Tipo di contratto</option>
                <option value="full-time" @selected(request('contract_type') == 'full-time')>Tempo pieno</option>
                <option value="part-time" @selected(request('contract_type') == 'part-time')>Part-time</option>
                <option value="temporary" @selected(request('contract_type') == 'temporary')>Temporaneo</option>
                <option value="contract" @selected(request('contract_type') == 'contract')>Contratto</option>
                <option value="stage" @selected(request('contract_type') == 'internship')>Stage / Tirocinio</option>
            </select>


            <input type="number" name="salary_min" placeholder="RAL minima" value="{{ request('salary_min') }}"
                class="border rounded px-2 py-1 w-full">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filtra</button>
            <a href="{{ route('public.jobs.index') }}"
                class="bg-gray-400 text-white px-4 py-2 rounded inline-block text-center">Pulisci filtri</a>
        </form>

        <h1 class="text-4xl font-extrabold text-gray-900 mb-10 text-center">Offerte di lavoro</h1>
        @if ($jobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($jobs as $job)
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-blue-700 mb-2">
                                <a href="{{ route('public.jobs.show', $job) }}">{{ $job->title }}</a>
                            </h2>
                            <div class="flex flex-wrap gap-2 mb-2 text-gray-600 text-sm">
                                <span
                                    class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded">{{ $job->contract_type }}</span>
                                <span class="inline-block">{{ $job->location }}</span>
                                @if ($job->salary)
                                    <span class="inline-block text-green-700 font-semibold">RAL:
                                        €{{ number_format($job->salary, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <p class="text-gray-700 line-clamp-3">{{ Str::limit($job->description, 120) }}</p>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('public.jobs.show', $job) }}"
                                class="bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-2 rounded-lg shadow font-semibold">Dettagli</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 flex justify-center">{{ $jobs->links() }}</div>
        @else
            <div class="text-center text-gray-500 py-20 text-lg">Nessun annuncio disponibile al momento.</div>
        @endif
    </div>
</x-app-layout>

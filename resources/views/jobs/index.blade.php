<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">I tuoi annunci</h2>
            <a href="{{ route('company.jobs.create') }}"
                class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded-lg shadow font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nuovo annuncio
            </a>
        </div>

        @if ($jobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $job->title }}</h3>
                            <p class="text-gray-500 text-sm mb-2">{{ $job->location }} <span class="mx-1">|</span>
                                <span
                                    class="inline-block px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">{{ $job->contract_type }}</span>
                            </p>
                            @if ($job->salary)
                                <p class="text-green-700 font-semibold">RAL:
                                    €{{ number_format($job->salary, 0, ',', '.') }}</p>
                            @endif
                        </div>
                        <a href="{{ route('company.jobs.applications.index', $job) }}" class="text-blue-600 underline">
                            Vedi candidature
                        </a>
                        <div class="flex gap-3 mt-6">
                            <a href="{{ route('company.jobs.edit', $job) }}"
                                class="text-blue-600 hover:underline font-medium">Modifica</a>
                            <form action="{{ route('company.jobs.destroy', $job) }}" method="POST"
                                onsubmit="return confirm('Sei sicuro di voler eliminare questo annuncio?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline font-medium">Elimina</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $jobs->links() }}</div>
        @else
            <div class="text-center text-gray-500 py-20 text-lg">Nessun annuncio trovato.</div>
        @endif
    </div>
</x-app-layout>

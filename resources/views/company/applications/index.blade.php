<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Candidature per: <span
                class="text-blue-700">{{ $job->title }}</span></h1>
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">{{ session('success') }}</div>
        @endif
        @if ($applications->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($applications as $application)
                    <div class="bg-white border border-gray-200 rounded-xl shadow p-6 flex flex-col justify-between">
                        <div class="mb-4">
                            <h2 class="text-lg font-bold text-gray-800 mb-1">{{ $application->user->name }}</h2>
                            <p class="text-gray-500 text-sm mb-2">{{ $application->user->email }}</p>
                        </div>
                        @if ($application->cv_path)
                            <p class="mt-2">
                                <a href="{{ asset('storage/' . $application->cv_path) }}"
                                    class="text-blue-600 underline" target="_blank">
                                    Scarica CV
                                </a>
                            </p>
                        @endif

                        <div class="mb-4">
                            <p class="font-semibold text-gray-700 mb-1">Lettera di presentazione:</p>
                            <p class="whitespace-pre-wrap text-gray-800">{{ $application->cover_letter }}</p>
                        </div>
                        <form action="{{ route('company.jobs.applications.update', [$job, $application]) }}"
                            method="POST" class="mt-2 flex items-center gap-3">
                            @csrf
                            @method('PUT')
                            <label class="block font-medium">Stato:</label>
                            <select name="status"
                                class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                                onchange="this.form.submit()">
                                <option value="in valutazione" @selected($application->status === 'in valutazione')>In valutazione</option>
                                <option value="accettata" @selected($application->status === 'accettata')>Accettata</option>
                                <option value="rifiutata" @selected($application->status === 'rifiutata')>Rifiutata</option>
                            </select>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 py-20 text-lg">Nessuna candidatura ricevuta per questo annuncio.</div>
        @endif
        <div class="mt-8">
            <a href="{{ route('company.jobs.index') }}" class="text-blue-600 hover:underline">&larr; Torna ai tuoi
                annunci</a>
        </div>
    </div>
</x-app-layout>

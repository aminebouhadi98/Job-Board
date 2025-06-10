<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <div class="bg-white rounded-xl shadow p-8 mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $job->title }}</h1>
            <div class="flex flex-wrap gap-4 mb-4 text-gray-600 text-sm">
                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded">{{ $job->contract_type }}</span>
                <span class="inline-block">{{ $job->location }}</span>
                @if ($job->salary)
                    <span class="inline-block text-green-700 font-semibold">RAL:
                        €{{ number_format($job->salary, 0, ',', '.') }}</span>
                @endif
            </div>
            <div class="prose max-w-none text-gray-800 mb-6">
                {{ $job->description }}
            </div>
        </div>

        @if (auth()->user()?->role === 'candidate')
            <div class="bg-gray-50 rounded-xl shadow p-8 mb-8">
                @if (session('error'))
                    <p class="text-red-600 mb-2">{{ session('error') }}</p>
                @endif
                <h2 class="text-xl font-bold mb-4">Candidati a questo annuncio</h2>
                @if (session('success'))
                    <p class="text-green-600 mb-4">{{ session('success') }}</p>
                @endif
                @if (session('error'))
                    <p class="text-green-600 mb-4">{{ session('error') }}</p>
                @endif

                @if (session('error_application'))
                    <p class="text-red-600 mb-4">{{ session('error_application') }}</p>
                @endif
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form method="POST" action="{{ route('jobs.apply', $job) }}" enctype="multipart/form-data">
                    @csrf

                    <textarea name="cover_letter" rows="4" class="w-full border rounded p-2 mb-3"
                        placeholder="Lettera di presentazione..." required>{{ old('cover_letter') }}</textarea>

                    <label class="block mb-2">Allega CV (PDF, DOC, DOCX):</label>
                    <input type="file" name="cv" accept=".pdf,.doc,.docx" class="mb-3">

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Invia candidatura
                    </button>
                </form>

            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('public.jobs.index') }}" class="text-blue-600 hover:underline">&larr; Torna alle
                offerte</a>
        </div>
    </div>
</x-app-layout>

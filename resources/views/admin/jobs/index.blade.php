<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Annunci da approvare</h1>
        @if (session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif
        @if ($jobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($jobs as $job)
                    <div class="bg-white border border-gray-200 rounded-xl shadow p-6 flex flex-col justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-blue-700 mb-2">{{ $job->title }}</h2>
                            <div class="flex flex-wrap gap-2 mb-2 text-gray-600 text-sm">
                                <span
                                    class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded">{{ $job->contract_type }}</span>
                                <span class="inline-block">{{ $job->location }}</span>
                                @if ($job->salary)
                                    <span class="inline-block text-green-700 font-semibold">RAL:
                                        €{{ number_format($job->salary, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <p class="text-gray-700 line-clamp-3 mb-4">{{ Str::limit($job->description, 120) }}</p>
                        </div>
                        <form method="POST" action="{{ route('admin.jobs.approve', $job) }}"
                            class="mt-2 flex justify-end">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 transition px-6 py-2 rounded-lg shadow font-semibold">Approva</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 py-20 text-lg">Nessun annuncio in attesa di approvazione.</div>
        @endif
    </div>
</x-app-layout>

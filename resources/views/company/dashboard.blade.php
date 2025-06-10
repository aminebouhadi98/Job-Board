<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard Azienda</h1>

        <p>Benvenuto, {{ auth()->user()->name }}!</p>

        <div class="mt-6">
            <a href="{{ route('company.jobs.index') }}"
                class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Gestisci annunci di lavoro
            </a>
        </div>
    </div>
</x-app-layout>

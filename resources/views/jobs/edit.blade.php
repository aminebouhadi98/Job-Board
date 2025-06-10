<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Modifica annuncio</h1>
        <div class="bg-white rounded-xl shadow p-8">
            <form action="{{ route('company.jobs.update', $job) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                @include('jobs.form', ['buttonText' => 'Aggiorna annuncio'])
            </form>
        </div>
    </div>
</x-app-layout>

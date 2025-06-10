<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Crea nuovo annuncio</h1>
        <div class="bg-white rounded-xl shadow p-8">
            <form action="{{ route('company.jobs.store') }}" method="POST" class="space-y-6">
                @include('jobs.form', ['buttonText' => 'Crea annuncio'])
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500 py-10 px-4">
        <div class="max-w-5xl mx-auto animate-fade-in">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8">Candidature per: <span
                    class="text-blue-700 dark:text-blue-300">{{ $job->title }}</span></h1>
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow animate-fade-in">{{
                    session('success') }}</div>
            @endif
            @if ($applications->count())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-fade-in">
                    @foreach ($applications as $application)
                        <div
                            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 p-6 flex flex-col justify-between group animate-fade-in">
                            <div class="mb-4">
                                <h2
                                    class="text-lg font-bold text-gray-800 dark:text-white mb-1 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-400 dark:text-blue-200" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $application->user->name }}
                                </h2>
                                <p class="text-gray-500 dark:text-gray-300 text-sm mb-2">{{
                                    $application->user->email }}</p>
                            </div>
                            @if ($application->cv_path)
                                <p class="mt-2">
                                    <a href="{{ asset('storage/' . $application->cv_path) }}"
                                        class="text-blue-600 dark:text-blue-300 underline" target="_blank">
                                        Scarica CV
                                    </a>
                                </p>
                            @endif
                            <div class="mb-4">
                                <p class="font-semibold text-gray-700 dark:text-gray-200 mb-1">Lettera di
                                    presentazione:</p>
                                <p class="whitespace-pre-wrap text-gray-800 dark:text-gray-100">{{
                                    $application->cover_letter }}</p>
                            </div>
                            <form action="{{ route('company.jobs.applications.update', [$job, $application]) }}"
                                method="POST" class="mt-2 flex items-center gap-3">
                                @csrf
                                @method('PUT')
                                <label
                                    class="block font-medium text-gray-700 dark:text-gray-200">Stato:</label>
                                <select name="status"
                                    class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition dark:bg-gray-800 dark:text-white"
                                    onchange="this.form.submit()">
                                    <option value="in valutazione"
                                        @selected($application->status === 'in valutazione')>In valutazione
                                    </option>
                                    <option value="accettata" @selected($application->status === 'accettata')>Accettata
                                    </option>
                                    <option value="rifiutata" @selected($application->status === 'rifiutata')>Rifiutata
                                    </option>
                                </select>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="text-center text-gray-500 dark:text-gray-400 py-20 text-lg animate-fade-in">
                    Nessuna candidatura ricevuta per questo annuncio.
                </div>
            @endif
            <div class="mt-8">
                <a href="{{ route('company.jobs.index') }}"
                    class="text-blue-600 dark:text-blue-300 hover:underline">&larr; Torna ai tuoi
                    annunci</a>
            </div>
        </div>
        <style>
            .animate-fade-in {
                transition: opacity 0.7s;
            }

            .opacity-0 {
                opacity: 0;
            }

            .animate-bounce-in {
                animation: bounce-in 0.7s;
            }

            @keyframes bounce-in {
                0% {
                    transform: scale(0.9);
                    opacity: 0;
                }

                60% {
                    transform: scale(1.05);
                    opacity: 1;
                }

                100% {
                    transform: scale(1);
                }
            }
        </style>
    </div>
</x-app-layout>

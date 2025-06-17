@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-fade-in">
    <div class="space-y-4">
        <div>
            <label class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Titolo</label>
            <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-900 dark:text-white transition"
                required>
        </div>
        <div>
            <label class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Città</label>
            <input type="text" name="location" value="{{ old('location', $job->location ?? '') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-900 dark:text-white transition"
                required>
        </div>
        <div>
            <label class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Modalità di lavoro</label>
            <input type="text" name="working_mode" value="{{ old('location', $job->working_mode ?? '') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-900 dark:text-white transition"
                required>
        </div>
        <div>
            <input type="checkbox" name="is_approved" value="1" class="form-checkbox text-blue-600 dark:bg-gray-800 dark:border-gray-700">
            <span class="text-gray-700 dark:text-gray-300">Approva</span>
        </div>
        <div>
            <label class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Tipo contratto</label>
            <select name="contract_type"
                class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-900 dark:text-white transition"
                required>
                @foreach (['full-time', 'part-time', 'stage'] as $type)
                    <option value="{{ $type }}" @selected(old('contract_type', $job->contract_type ?? '') === $type)>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">RAL (annua)</label>
            <input type="number" name="salary" value="{{ old('salary', $job->salary ?? '') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-900 dark:text-white transition">
        </div>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Descrizione</label>
        <textarea name="description" rows="10"
            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-900 dark:text-white transition resize-vertical"
            required>{{ old('description', $job->description ?? '') }}</textarea>
    </div>
</div>
<style>
    .animate-fade-in { animation: fadeIn 0.7s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: none; } }
</style>
@if(isset($buttonText))
    <div class="mt-8 flex justify-end">
        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2 rounded-lg shadow-lg font-semibold transition focus:outline-none focus:ring-2 focus:ring-blue-400 animate-bounce-in">
            {{ $buttonText }}
        </button>
    </div>
@endif
<style>
    .animate-bounce-in { animation: bounceIn 0.7s cubic-bezier(.68,-0.55,.27,1.55); }
    @keyframes bounceIn { 0% { opacity: 0; transform: scale(0.8);} 60% { opacity: 1; transform: scale(1.05);} 100% { transform: scale(1); } }
</style>

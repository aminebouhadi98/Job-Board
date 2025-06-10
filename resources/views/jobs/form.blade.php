@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-4">
        <div>
            <label class="block font-semibold mb-1">Titolo</label>
            <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required>
        </div>
        <div>
            <label class="block font-semibold mb-1">Città</label>
            <input type="text" name="location" value="{{ old('location', $job->location ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required>
        </div>
        <div>
            <label class="block font-semibold mb-1">Tipo contratto</label>
            <select name="contract_type" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required>
                @foreach (['full-time', 'part-time', 'stage'] as $type)
                    <option value="{{ $type }}" @selected(old('contract_type', $job->contract_type ?? '') === $type)>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">RAL (annua)</label>
            <input type="number" name="salary" value="{{ old('salary', $job->salary ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
        </div>
    </div>
    <div>
        <label class="block font-semibold mb-1">Descrizione</label>
        <textarea name="description" rows="10" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition resize-vertical" required>{{ old('description', $job->description ?? '') }}</textarea>
    </div>
</div>
<div class="mt-8 flex justify-end">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded-lg shadow font-semibold">
        {{ $buttonText ?? 'Salva' }}
    </button>
</div>

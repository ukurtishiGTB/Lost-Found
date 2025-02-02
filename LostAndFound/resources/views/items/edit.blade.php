<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ __('Edit Item') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl custom-shadow animate-fade-in" style="animation-delay: 0.2s">
                <div class="p-8">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-1 rounded-xl">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6">
                            <form method="POST" action="{{ route('items.update', $item) }}" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="glass-effect p-6 rounded-lg space-y-6">
                                    <div>
                                        <x-input-label for="title" :value="__('Title')" class="text-base mb-2" />
                                        <x-text-input id="title" name="title" type="text" 
                                            class="mt-1 block w-full text-base transition-all duration-200" 
                                            :value="old('title', $item->title)" required />
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="description" :value="__('Description')" class="text-base mb-2" />
                                        <textarea id="description" name="description" rows="4" 
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 text-base transition-all duration-200"
                                            required>{{ old('description', $item->description) }}</textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="location" :value="__('Location')" class="text-base mb-2" />
                                        <x-text-input id="location" name="location" type="text" 
                                            class="mt-1 block w-full text-base transition-all duration-200" 
                                            :value="old('location', $item->location)" required />
                                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <x-input-label for="category" :value="__('Category')" class="text-base mb-2" />
                                            <select id="category" name="category" 
                                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 text-base transition-all duration-200">
                                                @foreach(['electronics', 'jewelry', 'clothing', 'documents', 'other'] as $category)
                                                    <option value="{{ $category }}" {{ old('category', $item->category) === $category ? 'selected' : '' }}>
                                                        {{ ucfirst($category) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                        </div>

                                        <div>
                                            <x-input-label for="status" :value="__('Status')" class="text-base mb-2" />
                                            <select id="status" name="status" 
                                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 text-base transition-all duration-200">
                                                @foreach(['lost', 'found', 'claimed'] as $status)
                                                    <option value="{{ $status }}" {{ old('status', $item->status) === $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div id="date_found_container" class="transition-all duration-200" 
                                        x-data="{ show: '{{ old('status', $item->status) }}' === 'found' }"
                                        x-show="show">
                                        <x-input-label for="date_found" :value="__('Date Found')" class="text-base mb-2" />
                                        <x-text-input id="date_found" name="date_found" type="date" 
                                            class="mt-1 block w-full text-base transition-all duration-200" 
                                            :value="old('date_found', optional($item->date_found)->format('Y-m-d'))" />
                                        <x-input-error :messages="$errors->get('date_found')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-4 pt-4">
                                    <a href="{{ route('items.show', $item) }}" 
                                        class="text-sm font-medium text-gray-600 hover:text-gray-500 transition-colors duration-200">
                                        {{ __('Cancel') }}
                                    </a>
                                    <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white gradient-bg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                        {{ __('Update Item') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('status').addEventListener('change', function() {
            const dateFoundContainer = document.getElementById('date_found_container');
            dateFoundContainer.style.display = this.value === 'found' ? 'block' : 'none';
        });
    </script>
    @endpush
</x-app-layout>
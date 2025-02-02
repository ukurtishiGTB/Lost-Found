<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Report Lost/Found Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('items.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="electronics" {{ old('category') === 'electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="clothing" {{ old('category') === 'clothing' ? 'selected' : '' }}>Clothing</option>
                                <option value="accessories" {{ old('category') === 'accessories' ? 'selected' : '' }}>Accessories</option>
                                <option value="documents" {{ old('category') === 'documents' ? 'selected' : '' }}>Documents</option>
                                <option value="other" {{ old('category') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="lost" {{ old('status') === 'lost' ? 'selected' : '' }}>Lost</option>
                                <option value="found" {{ old('status') === 'found' ? 'selected' : '' }}>Found</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div id="date_found_container" style="display: none;">
                            <x-input-label for="date_found" :value="__('Date Found')" />
                            <x-text-input id="date_found" name="date_found" type="date" class="mt-1 block w-full" :value="old('date_found')" />
                            <x-input-error :messages="$errors->get('date_found')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
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

        // Show/hide date_found field on page load based on initial status value
        window.addEventListener('load', function() {
            const status = document.getElementById('status');
            const dateFoundContainer = document.getElementById('date_found_container');
            dateFoundContainer.style.display = status.value === 'found' ? 'block' : 'none';
        });
    </script>
    @endpush
</x-app-layout>
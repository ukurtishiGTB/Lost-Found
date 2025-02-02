<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ __('Report Item Found') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl custom-shadow animate-fade-in" style="animation-delay: 0.2s">
                <div class="p-8">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-1 rounded-xl">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6">
                            <div class="glass-effect p-6 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Item: {{ $item->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ $item->description }}</p>
                            </div>

                            <form method="POST" action="{{ route('items.mark-found', $item) }}" class="space-y-6">
                                @csrf
                                @method('PATCH')

                                <div class="glass-effect p-6 rounded-lg space-y-6">
                                    <div>
                                        <x-input-label for="location" :value="__('Found Location')" class="text-base mb-2" />
                                        <x-text-input id="location" name="location" type="text" 
                                            class="mt-1 block w-full text-base transition-all duration-200" 
                                            :value="old('location')" required 
                                            placeholder="Where was the item found?" />
                                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="date_found" :value="__('Date Found')" class="text-base mb-2" />
                                        <x-text-input id="date_found" name="date_found" type="date" 
                                            class="mt-1 block w-full text-base transition-all duration-200" 
                                            :value="old('date_found', now()->format('Y-m-d'))" required />
                                        <x-input-error :messages="$errors->get('date_found')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="notes" :value="__('Additional Notes')" class="text-base mb-2" />
                                        <textarea id="notes" name="notes" rows="4" 
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 text-base transition-all duration-200"
                                            placeholder="Any additional details about finding the item...">{{ old('notes') }}</textarea>
                                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-4 pt-4">
                                    <a href="{{ route('items.show', $item) }}" 
                                        class="text-sm font-medium text-gray-600 hover:text-gray-500 transition-colors duration-200">
                                        {{ __('Cancel') }}
                                    </a>
                                    <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white gradient-bg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        {{ __('Mark as Found') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
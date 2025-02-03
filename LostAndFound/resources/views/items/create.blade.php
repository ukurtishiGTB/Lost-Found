<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ __('Report Lost Item') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl custom-shadow animate-fade-in" style="animation-delay: 0.2s">
                <div class="p-8">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-1 rounded-xl">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6">
                            <form method="POST" action="{{ route('items.store') }}" class="space-y-6" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="status" value="lost">
                    
                                <div class="glass-effect p-6 rounded-lg space-y-6">
                                    <!-- Add this new image upload field -->
                                    <div>
                                        <x-input-label for="image" :value="__('Item Image')" class="text-base mb-2" />
                                        <input type="file" id="image" name="image" accept="image/*" required
                                            class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-300
                                            file:mr-4 file:py-2 file:px-4 file:rounded-lg
                                            file:border-0 file:font-medium
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100
                                            dark:file:bg-gray-700 dark:file:text-gray-300" />
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload a clear image of the item</p>
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>
                    
                                    <!-- Existing fields continue here -->
                                    <div>
                                        <x-input-label for="title" :value="__('Title')" class="text-base mb-2" />
                                        <x-text-input id="title" name="title" type="text" 
                                            class="mt-1 block w-full text-base transition-all duration-200" 
                                            :value="old('title')" required autofocus 
                                            placeholder="Enter a descriptive title" />
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="description" :value="__('Description')" class="text-base mb-2" />
                                        <textarea id="description" name="description" rows="4" 
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 text-base transition-all duration-200"
                                            required placeholder="Provide detailed description of the item...">{{ old('description') }}</textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="location" :value="__('Last Seen Location')" class="text-base mb-2" />
                                        <x-text-input id="location" name="location" type="text" 
                                            class="mt-1 block w-full text-base transition-all duration-200" 
                                            :value="old('location')" required 
                                            placeholder="Where was it last seen?" />
                                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="category" :value="__('Category')" class="text-base mb-2" />
                                        <select id="category" name="category" 
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 text-base transition-all duration-200">
                                            <option value="">Select a category</option>
                                            <option value="electronics">Electronics</option>
                                            <option value="jewelry">Jewelry</option>
                                            <option value="clothing">Clothing</option>
                                            <option value="documents">Documents</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-4 pt-4">
                                    <a href="{{ route('dashboard') }}" 
                                        class="text-sm font-medium text-gray-600 hover:text-gray-500 transition-colors duration-200">
                                        {{ __('Cancel') }}
                                    </a>
                                    <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white gradient-bg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                        {{ __('Submit Report') }}
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
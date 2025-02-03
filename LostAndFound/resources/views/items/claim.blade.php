<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ __('Claim Item') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl custom-shadow animate-fade-in">
                <div class="p-8">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-1 rounded-xl">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6">
                            <div class="glass-effect p-6 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Item: {{ $item->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ $item->description }}</p>
                            </div>

                            <form method="POST" action="{{ route('claims.store', $item) }}" class="space-y-6">
                                @csrf
                                
                                <div class="glass-effect p-6 rounded-lg space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <x-input-label for="claimer_name" :value="__('Your Name')" />
                                            <x-text-input id="claimer_name" name="claimer_name" type="text" required class="mt-1 block w-full" />
                                            <x-input-error :messages="$errors->get('claimer_name')" class="mt-2" />
                                        </div>

                                        <div>
                                            <x-input-label for="claimer_email" :value="__('Your Email')" />
                                            <x-text-input id="claimer_email" name="claimer_email" type="email" required class="mt-1 block w-full" />
                                            <x-input-error :messages="$errors->get('claimer_email')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label for="proof_description" :value="__('Proof of Ownership')" />
                                        <textarea id="proof_description" name="proof_description" rows="4" required
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="Please provide detailed information to prove this item belongs to you..."></textarea>
                                        <x-input-error :messages="$errors->get('proof_description')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('items.show', $item) }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                                    <x-primary-button>Submit Claim</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
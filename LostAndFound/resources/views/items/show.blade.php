<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ $item->title }}
            </h2>
            <div class="flex items-center space-x-4">
                @can('update', $item)
                    <a href="{{ route('items.edit', $item) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white gradient-bg rounded-lg hover:opacity-90 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl custom-shadow animate-fade-in">
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Add Image Display -->
                        <div class="lg:col-span-2">
                            @if($item->image)
                                <div class="rounded-xl overflow-hidden mb-6">
                                    <img src="{{ Storage::url($item->image) }}" 
                                         alt="{{ $item->title }}"
                                         class="w-full h-auto object-cover" />
                                </div>
                            @endif
                            <div class="glass-effect p-6 rounded-xl">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Description</h3>
                                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $item->description }}</p>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1 animate-fade-in" style="animation-delay: 0.3s">
                            <div class="glass-effect rounded-xl p-6 space-y-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Details</h3>
                                <dl class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                        <dd class="mt-1">
                                            <span class="status-badge {{ 
                                                $item->status === 'lost' ? 'bg-red-100 text-red-800' : 
                                                ($item->status === 'found' ? 'bg-green-100 text-green-800' : 
                                                'bg-blue-100 text-blue-800') }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="card-hover p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Location</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $item->location }}</dd>
                                    </div>
                                    <div class="card-hover p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ ucfirst($item->category) }}</dd>
                                    </div>
                                    @if($item->date_found)
                                        <div class="card-hover p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date Found</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $item->date_found->format('M d, Y') }}</dd>
                                        </div>
                                    @endif
                                    <div class="card-hover p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Posted By</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $item->user->name }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
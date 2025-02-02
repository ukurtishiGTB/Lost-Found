<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white gradient-bg rounded-lg hover:opacity-90 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                {{ __('Report Item') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Lost Items Section -->
            <div class="animate-fade-in" style="animation-delay: 0.2s">
                <h3 class="text-xl font-bold mb-6 text-gray-800 dark:text-gray-200 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Lost Items
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($lostItems as $item)
                        <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden custom-shadow">
                            <div class="p-6">
                                <h4 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">{{ $item->title }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $item->description }}</p>
                                <div class="glass-effect p-3 rounded-lg mb-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        <span class="font-medium">Location:</span> {{ $item->location }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="status-badge bg-red-100 text-red-800">Lost</span>
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('items.show', $item) }}" class="text-indigo-600 hover:text-indigo-500 font-medium text-sm hover:underline">View Details</a>
                                        @if($item->status === 'lost')
                                            <a href="{{ route('items.report-found', $item) }}" class="text-green-600 hover:text-green-500 font-medium text-sm hover:underline">Report Found</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Found Items Section -->
            <div class="animate-fade-in" style="animation-delay: 0.4s">
                <h3 class="text-xl font-bold mb-6 text-gray-800 dark:text-gray-200 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Found Items
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($foundItems as $item)
                        <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden custom-shadow">
                            <div class="p-6">
                                <h4 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">{{ $item->title }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $item->description }}</p>
                                <div class="glass-effect p-3 rounded-lg mb-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        <span class="font-medium">Found at:</span> {{ $item->location }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="status-badge bg-green-100 text-green-800">Found</span>
                                    <a href="{{ route('items.show', $item) }}" class="text-indigo-600 hover:text-indigo-500 font-medium text-sm hover:underline">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

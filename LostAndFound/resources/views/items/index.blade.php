<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ $title ?? 'Items' }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($items->isEmpty())
                <div class="text-center py-12 animate-fade-in">
                    <p class="text-xl text-gray-600 dark:text-gray-400">No items found.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                        <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden custom-shadow animate-fade-in" style="animation-delay: {{ $loop->iteration * 0.1 }}s">
                            @if($item->image)
                                <div class="aspect-w-16 aspect-h-9">
                                    <img src="{{ Storage::url($item->image) }}" 
                                         alt="{{ $item->title }}"
                                         class="w-full h-48 object-cover" />
                                </div>
                            @endif
                            <div class="p-6">
                                <h4 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">{{ $item->title }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $item->description }}</p>
                                <div class="glass-effect p-3 rounded-lg mb-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        <span class="font-medium">Location:</span> {{ $item->location }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                                        <span class="font-medium">Reported by:</span> {{ $item->reporter_name }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                                        <span class="font-medium">Date:</span> {{ $item->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="status-badge {{ $item->status === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('items.show', $item) }}" class="text-indigo-600 hover:text-indigo-500 font-medium text-sm hover:underline">View Details</a>
                                        @if($item->status === 'found')
                                            <a href="{{ route('items.claim', $item) }}" class="text-green-600 hover:text-green-500 font-medium text-sm hover:underline">
                                                Claim Item
                                            </a>
                                        @endif
                                        @auth
                                            @if(auth()->user()->is_admin)
                                                <a href="{{ route('items.edit', $item) }}" class="text-blue-600 hover:text-blue-500 font-medium text-sm hover:underline">Edit</a>
                                                <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-500 font-medium text-sm hover:underline" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
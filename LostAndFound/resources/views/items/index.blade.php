
<x-app-layout>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $title ?? 'Items' }}
        </h2>
    </x-slot:header>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('items.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    Report Item
                </a>
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($items->isEmpty())
                        <p class="text-gray-500 text-center py-4">No items found.</p>
                    @else
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($items as $item)
                                <div class="p-4 border rounded-lg shadow-sm hover:shadow-md transition">
                                    <h3 class="text-lg font-semibold mb-2">{{ $item->title }}</h3>
                                    <p class="text-gray-600 mb-2 line-clamp-2">{{ $item->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="px-2 py-1 text-sm rounded-full {{ $item->status === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                        <a href="{{ route('items.show', $item) }}" class="text-blue-500 hover:underline">
                                            View Details
                                        </a>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-500">
                                        <p>Location: {{ $item->location }}</p>
                                        <p>Posted by: {{ $item->user->name }}</p>
                                        <p>Date: {{ $item->created_at->format('M d, Y') }}</p>
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
        </div>
    </div>
</x-app-layout>
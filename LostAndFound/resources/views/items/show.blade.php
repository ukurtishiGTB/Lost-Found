<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $item->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Description</h3>
                        <p class="mt-2">{{ $item->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Details</h3>
                        <dl class="mt-2 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <dt class="font-medium">Location</dt>
                                <dd>{{ $item->location }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium">Category</dt>
                                <dd>{{ ucfirst($item->category) }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium">Status</dt>
                                <dd>
                                    <span class="px-2 py-1 text-sm {{ $item->status === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </dd>
                            </div>
                            @if($item->date_found)
                            <div>
                                <dt class="font-medium">Date Found</dt>
                                <dd>{{ $item->date_found->format('Y-m-d') }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    @if($item->status !== 'claimed' && auth()->id() !== $item->user_id)
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4">Submit a Claim</h3>
                            <form method="POST" action="{{ route('claims.store', $item) }}" class="space-y-6">
                                @csrf
                                <div>
                                    <x-input-label for="proof_description" :value="__('Proof Description')" />
                                    <textarea id="proof_description" name="proof_description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                                    <x-input-error :messages="$errors->get('proof_description')" class="mt-2" />
                                </div>
                                <div class="flex justify-end">
                                    <x-primary-button>{{ __('Submit Claim') }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if($item->claims->isNotEmpty() && (auth()->user()->is_admin || auth()->id() === $item->user_id))
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4">Claims</h3>
                            <div class="space-y-4">
                                @foreach($item->claims as $claim)
                                    <div class="border p-4 rounded-lg">
                                        <p class="mb-2">{{ $claim->proof_description }}</p>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">By: {{ $claim->user->name }}</span>
                                            @if(auth()->user()->is_admin && !$claim->verified)
                                                <form method="POST" action="{{ route('claims.verify', $claim) }}">
                                                    @csrf
                                                    <x-primary-button>{{ __('Verify Claim') }}</x-primary-button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @can('update', $item)
                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('items.edit', $item) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Edit') }}
                            </a>
                            <form method="POST" action="{{ route('items.destroy', $item) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-danger-button onclick="return confirm('Are you sure you want to delete this item?')">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
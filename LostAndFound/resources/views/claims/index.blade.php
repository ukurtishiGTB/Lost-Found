<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 animate-fade-in">
                {{ __('Claims Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl custom-shadow">
                <div class="p-8">
                    @if($claims->isEmpty())
                        <div class="text-center py-12 glass-effect rounded-lg">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">No claims yet</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Claims for found items will appear here.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($claims as $claim)
                                <div class="card-hover bg-gray-50 dark:bg-gray-700/50 rounded-lg overflow-hidden">
                                    <div class="p-6">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-3">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        {{ $claim->item->title }}
                                                    </h3>
                                                    <span class="status-badge {{ $claim->verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ $claim->verified ? 'Verified' : 'Pending' }}
                                                    </span>
                                                </div>
                                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                                    Claimed by: {{ $claim->user->name }}
                                                </p>
                                                <div class="mt-3 glass-effect p-4 rounded-lg">
                                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white">Proof Description:</h4>
                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                                        {{ $claim->proof_description }}
                                                    </p>
                                                </div>
                                                <div class="mt-2 text-sm text-gray-500">
                                                    Submitted: {{ $claim->created_at->format('M d, Y H:i') }}
                                                </div>
                                            </div>
                                            
                                            <div class="ml-6 flex items-center space-x-4">
                                                <a href="{{ route('items.show', $claim->item) }}" 
                                                    class="text-indigo-600 hover:text-indigo-500 font-medium text-sm hover:underline">
                                                    View Item
                                                </a>
                                                @if(!$claim->verified)
                                                    <form action="{{ route('claims.verify', $claim) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" 
                                                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white gradient-bg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                            Verify Claim
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
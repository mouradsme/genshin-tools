<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">{{ $region->name }}</h2>
                <a href="{{ route('regions.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 tracking-widest hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to Regions
                </a>
            </div>

            <div class="space-y-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Region Cover Image -->
                    <div class="h-64 bg-gray-100">
                        @if($region->cover_image)
                            <img src="{{ asset('storage/' . $region->cover_image) }}" alt="{{ $region->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Region Details -->
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900">Description</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $region->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- World Quests List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">World Quests</h3>
                        <div class="space-y-4">
                            @forelse($region->worldQuests as $quest)
                                <div class="border-b border-gray-200 last:border-0 pb-4 last:pb-0">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-base font-medium text-indigo-600">
                                                {{ $quest->name }}
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $quest->description }}
                                            </p>
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('world-quests.show', $quest) }}" class="inline-flex items-center px-4 py-2 bg-indigo-100 border border-transparent rounded-md font-semibold text-xs text-indigo-700 tracking-widest hover:bg-indigo-200 focus:bg-indigo-200 active:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No world quests found for this region.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
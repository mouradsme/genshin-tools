<x-admin-layout>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-900">{{ $region->name }}</h2>
            <a href="{{ route('admin.regions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Back to Regions
            </a>
        </div>

        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <!-- Region Cover Image -->
            <div class="h-64 bg-gray-200">
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
            <div class="px-4 py-5 sm:p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Description</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $region->description }}</p>
                </div>

                <!-- World Quests List -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">World Quests</h3>
                        <a href="{{ route('admin.world-quests.create', ['region_id' => $region->id]) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Add Quest
                        </a>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul class="divide-y divide-gray-200">
                            @forelse($region->worldQuests as $quest)
                                <li>
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                    {{ $quest->name }}
                                                </p>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ Str::limit($quest->description, 100) }}
                                                </p>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('admin.world-quests.edit', $quest) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="px-4 py-4 sm:px-6">
                                    <p class="text-sm text-gray-500">No world quests found for this region.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 
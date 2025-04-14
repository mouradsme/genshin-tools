<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">World Quests</h2>

            <div class="space-y-4">
                @forelse($worldQuests as $quest)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-indigo-600">
                                        {{ $quest->name }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $quest->description }}
                                    </p>
                                    <p class="mt-2 text-sm text-gray-400">
                                        Region: {{ $quest->region->name }}
                                    </p>
                                </div>
                                <div class="ml-4">
                                    <a href="{{ route('world-quests.show', $quest) }}" class="inline-flex items-center px-4 py-2 bg-indigo-100 border border-transparent rounded-md font-semibold text-xs text-indigo-700 tracking-widest hover:bg-indigo-200 focus:bg-indigo-200 active:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            No world quests found.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout> 
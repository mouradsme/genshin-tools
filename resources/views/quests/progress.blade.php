<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Quest Progress</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Not Started Quests -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Not Started</h3>
                        <div class="space-y-4">
                            @forelse($userQuests['not_started'] ?? [] as $userQuest)
                                <div class="border-b border-gray-200 last:border-0 pb-4 last:pb-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-base font-medium text-indigo-600">
                                                {{ $userQuest->worldQuest->name }}
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Region: {{ $userQuest->worldQuest->region->name }}
                                            </p>
                                        </div>
                                        <div class="ml-4 flex items-center space-x-2">
                                            <form action="{{ route('quest-progress.update', $userQuest) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="in_progress">
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-indigo-100 border border-transparent rounded-md text-xs text-indigo-700 hover:bg-indigo-200">
                                                    Start
                                                </button>
                                            </form>
                                            <form action="{{ route('quest-progress.destroy', $userQuest) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-100 border border-transparent rounded-md text-xs text-red-700 hover:bg-red-200">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No quests to start.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- In Progress Quests -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">In Progress</h3>
                        <div class="space-y-4">
                            @forelse($userQuests['in_progress'] ?? [] as $userQuest)
                                <div class="border-b border-gray-200 last:border-0 pb-4 last:pb-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-base font-medium text-indigo-600">
                                                {{ $userQuest->worldQuest->name }}
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Region: {{ $userQuest->worldQuest->region->name }}
                                            </p>
                                        </div>
                                        <div class="ml-4 flex items-center space-x-2">
                                            <form action="{{ route('quest-progress.update', $userQuest) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-100 border border-transparent rounded-md text-xs text-green-700 hover:bg-green-200">
                                                    Complete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No quests in progress.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Completed Quests -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Completed</h3>
                        <div class="space-y-4">
                            @forelse($userQuests['completed'] ?? [] as $userQuest)
                                <div class="border-b border-gray-200 last:border-0 pb-4 last:pb-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-base font-medium text-gray-600">
                                                {{ $userQuest->worldQuest->name }}
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Region: {{ $userQuest->worldQuest->region->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No completed quests.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Quests -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Available Quests</h3>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @forelse($availableQuests as $quest)
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-base font-medium text-indigo-600">
                                                {{ $quest->name }}
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Region: {{ $quest->region->name }}
                                            </p>
                                        </div>
                                        <div class="ml-4">
                                            <form action="{{ route('quest-progress.store', $quest) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-indigo-100 border border-transparent rounded-md text-xs text-indigo-700 hover:bg-indigo-200">
                                                    Track
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No available quests.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">{{ $worldQuest->name }}</h2>
                <a href="{{ route('world-quests.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 tracking-widest hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to World Quests
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Region</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                <a href="{{ route('regions.show', $worldQuest->region) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                    {{ $worldQuest->region->name }}
                                </a>
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Description</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $worldQuest->description }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Guide</h3>
                            <p class="mt-1">
                                <a href="{{ $worldQuest->guide_link }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-100 border border-transparent rounded-md font-semibold text-xs text-indigo-700 tracking-widest hover:bg-indigo-200 focus:bg-indigo-200 active:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    View Quest Guide
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
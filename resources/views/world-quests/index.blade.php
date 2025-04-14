<x-app-layout>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#quest-search').on('input', function() {
                var searchTerm = $(this).val().toLowerCase();
                
                // Filter quests
                $('.quest-item').each(function() {
                    var questName = $(this).find('.quest-name').text().toLowerCase();
                    var regionName = $(this).find('.quest-region').text().toLowerCase();
                    var description = $(this).find('.quest-description').text().toLowerCase();
                    var matches = questName.includes(searchTerm) || 
                                regionName.includes(searchTerm) || 
                                description.includes(searchTerm);
                    $(this).toggle(matches);
                });

                // Show/hide no results message
                $('.no-results').toggle($('.quest-item:visible').length === 0 && searchTerm !== '');
                $('.empty-state').toggle($('.quest-item').length === 0);
            });
        });
    </script>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">World Quests</h2>
                <div class="w-72">
                    <input type="text" id="quest-search" placeholder="Search quests..." 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>

            <div class="no-results hidden">
                <p class="text-gray-600 text-center py-4">No quests found matching your search.</p>
            </div>

            <div class="space-y-4">
                @forelse($worldQuests as $quest)
                    <div class="quest-item bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="quest-name text-lg font-medium text-indigo-600">
                                        {{ $quest->name }}
                                    </h3>
                                    <p class="quest-description mt-1 text-sm text-gray-500">
                                        {{ $quest->description }}
                                    </p>
                                    <p class="quest-region mt-2 text-sm text-gray-400">
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
                    <p class="empty-state text-gray-600 text-center py-4">No world quests available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout> 
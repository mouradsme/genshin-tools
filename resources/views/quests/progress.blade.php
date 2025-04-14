<x-app-layout>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#quest-search').on('input', function() {
                var searchTerm = $(this).val().toLowerCase();
                
                // Filter completed quests
                $('.completed-quest').each(function() {
                    var questName = $(this).find('.quest-name').text().toLowerCase();
                    var regionName = $(this).find('.quest-region').text().toLowerCase();
                    var matches = questName.includes(searchTerm) || regionName.includes(searchTerm);
                    $(this).toggle(matches);
                });

                // Filter available quests
                $('.available-quest').each(function() {
                    var questName = $(this).find('.quest-name').text().toLowerCase();
                    var regionName = $(this).find('.quest-region').text().toLowerCase();
                    var matches = questName.includes(searchTerm) || regionName.includes(searchTerm);
                    $(this).toggle(matches);
                });

                // Update empty state messages
                $('.completed-empty').toggle($('.completed-quest:visible').length === 0 && searchTerm === '');
                $('.available-empty').toggle($('.available-quest:visible').length === 0 && searchTerm === '');

                // Show no results message when searching
                $('.no-results').toggle(
                    searchTerm !== '' && 
                    $('.completed-quest:visible').length === 0 && 
                    $('.available-quest:visible').length === 0
                );
            });
        });
    </script>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Quest Progress</h2>
                        <div class="w-72">
                            <input type="text" id="quest-search" placeholder="Search quests..." 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="no-results hidden">
                        <p class="text-gray-600 text-center py-4">No quests found matching your search.</p>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Completed Quests</h3>
                        @if(isset($userQuests['completed']) && $userQuests['completed']->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($userQuests['completed'] as $userQuest)
                                    <div class="completed-quest bg-gray-50 p-4 rounded-lg shadow">
                                        <h4 class="quest-name font-medium">{{ $userQuest->worldQuest->name }}</h4>
                                        <p class="quest-region text-sm text-gray-600">Region: {{ $userQuest->worldQuest->region->name }}</p>
                                        <div class="mt-2 flex items-center space-x-2">
                                            <a href="{{ $userQuest->worldQuest->guide_link }}" target="_blank" class="text-indigo-600 text-sm hover:text-indigo-800">View Guide</a>
                                            <form action="{{ route('quest-progress.destroy', $userQuest) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 text-sm hover:text-red-800">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="completed-empty text-gray-600">No completed quests yet.</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4">Available Quests</h3>
                        @if($availableQuests->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($availableQuests as $quest)
                                    <div class="available-quest bg-gray-50 p-4 rounded-lg shadow">
                                        <h4 class="quest-name font-medium">{{ $quest->name }}</h4>
                                        <p class="quest-region text-sm text-gray-600">Region: {{ $quest->region->name }}</p>
                                        <div class="mt-2 flex items-center space-x-2">
                                            <a href="{{ $quest->guide_link }}" target="_blank" class="text-indigo-600 text-sm hover:text-indigo-800">View Guide</a>
                                            <form action="{{ route('quest-progress.store', $quest) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-blue-600 text-sm hover:text-blue-800">Mark as Completed</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="available-empty text-gray-600">No available quests found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
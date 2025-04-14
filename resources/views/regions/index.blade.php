<x-app-layout>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#region-search').on('input', function() {
                var searchTerm = $(this).val().toLowerCase();
                
                // Filter regions
                $('.region-item').each(function() {
                    var regionName = $(this).find('.region-name').text().toLowerCase();
                    var description = $(this).find('.region-description').text().toLowerCase();
                    var matches = regionName.includes(searchTerm) || description.includes(searchTerm);
                    $(this).toggle(matches);
                });

                // Show/hide no results message
                $('.no-results').toggle($('.region-item:visible').length === 0 && searchTerm !== '');
                $('.empty-state').toggle($('.region-item').length === 0);
            });
        });
    </script>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">Regions</h2>
                <div class="w-72">
                    <input type="text" id="region-search" placeholder="Search regions..." 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>

            <div class="no-results hidden">
                <p class="text-gray-600 text-center py-4">No regions found matching your search.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($regions as $region)
                    <div class="region-item bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="relative h-48">
                            @if($region->cover_image)
                                <img src="{{ Storage::url($region->cover_image) }}" alt="{{ $region->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">No image</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="region-name text-lg font-medium text-gray-900">
                                {{ $region->name }}
                            </h3>
                            <p class="region-description mt-2 text-sm text-gray-500">
                                {{ $region->description }}
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('regions.show', $region) }}" class="inline-flex items-center px-4 py-2 bg-indigo-100 border border-transparent rounded-md font-semibold text-xs text-indigo-700 tracking-widest hover:bg-indigo-200 focus:bg-indigo-200 active:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    View Quests
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="empty-state text-gray-600 text-center py-4">No regions available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout> 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Regions Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Regions</h3>
                            <a href="{{ route('regions.index') }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                View All
                            </a>
                        </div>
                        <div class="mt-4">
                            <ul class="divide-y divide-gray-200">
                                @forelse($regions->take(3) as $region)
                                    <li class="py-2">
                                        <a href="{{ route('regions.show', $region) }}" class="flex items-center justify-between">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                    {{ $region->name }}
                                                </p>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ Str::limit($region->description, 50) }}
                                                </p>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="py-2">
                                        <p class="text-sm text-gray-500">No regions found.</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- World Quests Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">World Quests</h3>
                            <a href="{{ route('world-quests.index') }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                View All
                            </a>
                        </div>
                        <div class="mt-4">
                            <ul class="divide-y divide-gray-200">
                                @forelse($worldQuests->take(3) as $quest)
                                    <li class="py-2">
                                        <a href="{{ route('world-quests.show', $quest) }}" class="flex items-center justify-between">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                    {{ $quest->name }}
                                                </p>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ Str::limit($quest->description, 50) }}
                                                </p>
                                                <p class="mt-1 text-xs text-gray-400">
                                                    {{ $quest->region->name }}
                                                </p>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="py-2">
                                        <p class="text-sm text-gray-500">No world quests found.</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

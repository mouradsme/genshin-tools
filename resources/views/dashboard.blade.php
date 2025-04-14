<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Your Quest Tracker</h2>

                    <!-- Active Quests -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Active Quests</h3>
                        <div class="space-y-4">
                            @forelse($activeQuests ?? [] as $userQuest)
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-base font-medium text-indigo-600">
                                                {{ $userQuest->worldQuest->name }}
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Region: {{ $userQuest->worldQuest->region->name }}
                                            </p>
                                            <p class="mt-2 text-sm text-gray-600">
                                                Status: <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $userQuest->status)) }}</span>
                                            </p>
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('quest-progress.index') }}" class="inline-flex items-center px-3 py-1 bg-indigo-100 border border-transparent rounded-md text-xs text-indigo-700 hover:bg-indigo-200">
                                                Update Progress
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <p class="text-sm text-gray-500 mb-4">You haven't started tracking any quests yet.</p>
                                    <a href="{{ route('quest-progress.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-white hover:bg-indigo-700">
                                        Start Tracking Quests
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-indigo-50 rounded-lg p-6">
                            <h4 class="text-sm font-medium text-indigo-900 mb-2">Total Quests</h4>
                            <p class="text-2xl font-semibold text-indigo-600">{{ $stats['total'] ?? 0 }}</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-6">
                            <h4 class="text-sm font-medium text-green-900 mb-2">Completed</h4>
                            <p class="text-2xl font-semibold text-green-600">{{ $stats['completed'] ?? 0 }}</p>
                        </div>
                        <div class="bg-yellow-50 rounded-lg p-6">
                            <h4 class="text-sm font-medium text-yellow-900 mb-2">In Progress</h4>
                            <p class="text-2xl font-semibold text-yellow-600">{{ $stats['in_progress'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

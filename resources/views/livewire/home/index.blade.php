<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Home</h1>
        <p class="text-gray-600">Manage and browse all users in the system</p>
    </div>

    <!-- Search and Filters -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <!-- Search Input -->
            <div class="w-full sm:w-auto">
                <x-input 
                    wire:model.live.debounce.100ms="search" 
                    placeholder="Search users by name or email..." 
                    icon="o-magnifying-glass"
                    class="min-w-80"
                />
            </div>
            
            <!-- Per Page Selector -->
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600">Show:</span>
                <select wire:model.live="perPage" class="select select-bordered w-20">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span class="text-sm text-gray-600">per page</span>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class=" rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <x-table 
            :headers="$headers" 
            :rows="$users" 
            striped 
            class="table-auto"
        >
            @scope('cell_created_at', $user)
                <span class="text-sm text-gray-500">
                    {{ $user->created_at->format('M d, Y') }}
                </span>
            @endscope

            @scope('actions', $user)
                <div class="flex gap-2">
                    <x-button 
                        icon="o-eye" 
                        class="btn-sm btn-ghost"
                        title="View User"
                    />
                    <x-button 
                        icon="o-pencil" 
                        class="btn-sm btn-ghost"
                        title="Edit User"
                    />
                </div>
            @endscope
        </x-table>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Empty State -->
    @if($users->isEmpty())
        <div class="text-center py-12">
            <div class="mx-auto h-12 w-12 text-gray-400">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
            </div>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if($search)
                    Try adjusting your search terms.
                @else
                    Get started by adding a new user.
                @endif
            </p>
        </div>
    @endif
</div>
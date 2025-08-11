<div class="">
    <h1 class="text-2xl font-bold mb-6">Posts</h1>

    {{-- Header actions --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="w-full md:w-auto">
            <x-button 
                label="Create New Post" 
                class="btn-primary w-full md:w-auto"   
                link="{{ route('posts.create') }}"  
            />
        </div>
        
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center w-full md:w-auto">
            <x-select 
                label="Right icon" 
                wire:model.live="selectedUser" 
                :options="$user" 
                icon-right="o-user"  
                placeholder="All User" 
                placeholder-value=""
                class="w-full sm:w-48"
            />

            <x-choices
                label="Searchable + Multiple"
                wire:model.live="users_multi_searchable_ids"
                :options="$usersMultiSearchable"
                placeholder="Search ..."
                no-result-text="Ops! Nothing here ..."        
                searchable
                clearable
                values-as-string
                class="w-full sm:w-64"
            />
        </div>
    </div>

    {{-- Posts list --}}
    <div class="mt-6 grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @forelse($posts as $post)
            <x-card 
                title="{{ $post->title }}" 
                subtitle="{{ $post->user->name }}" 
                shadow 
                separator 
                class="border border-gray-200 w-full"
                wire:key="{{ $post->id }}"
            >
                {{ $post->body }}
                <div class="flex justify-end mt-4 gap-2">
                    <x-button 
                        icon="o-pencil" 
                        class="btn-sm btn-ghost"
                        title="Edit Posts"
                        link="{{ route('posts.edit', $post->id) }}"
                    />
                    <x-button 
                        icon="o-trash" 
                        class="btn-sm btn-ghost"
                        title="Delete Posts"
                        wire:click="delete({{ $post->id }})"
                        wire:confirm="Are you sure?"
                    />
                </div>
            </x-card>
        @empty
            <div class="text-center text-gray-500 col-span-full">No posts found.</div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    <div class="px-6 py-4">
        {{ $posts->links() }}
    </div>
</div>

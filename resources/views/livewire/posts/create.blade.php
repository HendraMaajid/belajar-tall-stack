<div class="w-1/2 mx-auto">
    <x-card 
        title="{{ $post ? 'Edit Post' : 'New Post' }}" 
        subtitle="{{ $post ? 'Update your post' : 'Create a new post' }}" 
        shadow separator
    >
        <x-form wire:submit="save" no-separator>
            <x-input label="Title" wire:model="form.title" />
            <x-textarea label="Posts" wire:model="form.body" placeholder="Here make your posts ..." hint="Max 1000 chars" rows="5" />

            <x-slot:actions>
                <x-button label="{{ $post ? 'Update' : 'Simpan!' }}" class="btn-primary" type="submit" />
                <x-button label="Cancel" class="btn-primary" link="{{route('posts.index')}}" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>

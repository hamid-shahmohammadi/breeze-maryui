<div>
    <x-mary-header title="Post" subtitle="This is posts">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>

            <x-mary-button @click="$wire.postModal = true" icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-mary-header>


    <x-mary-modal wire:model="postModal" class="backdrop-blur">
        <x-mary-form wire:submit="save">
            <x-mary-input label="Title" wire:model="form.title" />
            <x-mary-input label="Slug" wire:model="form.slug" />
            <x-mary-textarea label="Content" wire:model="form.content" placeholder="Your story ..."
                hint="Max 1000 chars" rows="5" />


            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.postModal = false" />
                <x-mary-button label="Save" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-mary-form>

    </x-mary-modal>

    <x-mary-table :headers="$headers" :rows="$posts" striped @row-click="alert($event.detail.title)" :sort-by="$sortBy">
        @scope('cell_id', $post)
            <strong>{{ $post->id }}</strong>
        @endscope
        @scope('cell_title', $post)
            <x-mary-badge :value="$post->title" class="badge-primary" />
        @endscope
        @scope('actions', $post)
        <div class="flex">
            <x-mary-button @click="$wire.editPost({{$post}})" icon="o-pencil-square" spinner class="btn-sm btn-primary" />
            <x-mary-button @click="confirm('Are you sure?') ? $wire.deletePost({{$post}}) : false"
              icon="o-trash" spinner class="btn-sm btn-error ml-2" />
        </div>
        @endscope
    </x-mary-table>
    <p class="mt-4">
        {{ $posts->links('custom-paginate') }}
    </p>


    <x-mary-modal wire:model="editModal" class="backdrop-blur">
        <x-mary-form wire:submit="update">
            <x-mary-input label="Title" wire:model="form.title" />
            <x-mary-input label="Slug" wire:model="form.slug" />
            <x-mary-textarea label="Content" wire:model="form.content" placeholder="Your content ..."
                hint="Max 1000 chars" rows="5" inline />

            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.editModal = false" />
                <x-mary-button label="Update" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-mary-form>

    </x-mary-modal>

</div>

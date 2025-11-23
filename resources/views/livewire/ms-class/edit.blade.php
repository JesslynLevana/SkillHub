<div class="space-y-6">
    <div>
        <flux:heading size="lg">Edit Class</flux:heading>
        <flux:text class="mt-2">Update class information</flux:text>
    </div>

    @if($id && $class)
    <form wire:submit="update({{ $id }})" class="space-y-6">
                <flux:input 
                    wire:model="name" label="Class Name" type="text" placeholder="Enter class name" />
                @error('name') <flux:error>{{ $message }}</flux:error> @enderror

                <flux:textarea 
                    wire:model="description" label="Description"
                    placeholder="Enter class description"
                    rows="3"
                />
                @error('description') <flux:error>{{ $message }}</flux:error> @enderror

                <flux:input 
                    wire:model="instructor" label="Instructor" type="text" placeholder="Enter instructor name"
                />
                @error('instructor') <flux:error>{{ $message }}</flux:error> @enderror

        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button variant="primary" type="submit">Update Class</flux:button>
        </div>
    </form>
    @else
    <div class="text-center py-4">
        <flux:text>Loading...</flux:text>
    </div>
    @endif
</div>

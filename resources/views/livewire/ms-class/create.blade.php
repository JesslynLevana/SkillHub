<div class="space-y-6">
    <div>
        <flux:heading size="lg">Add New Class</flux:heading>
        <flux:text class="mt-2">Enter class information below</flux:text>
    </div>

    <form wire:submit="store" class="space-y-6">
                <flux:input 
                    wire:model="name" label="Class Name" type="text" placeholder="Enter class name" />
                @error('name') <flux:error>{{ $message }}</flux:error> @enderror

                <flux:textarea 
                    wire:model="description" label="Description" placeholder="Enter class description"
                    rows="3"
                />
                @error('description') <flux:error>{{ $message }}</flux:error> @enderror

                <flux:input 
                    wire:model="instructor" label="Instructor" type="text" placeholder="Enter instructor name" />
                @error('instructor') <flux:error>{{ $message }}</flux:error> @enderror

        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button variant="primary" type="submit">Add Class</flux:button>
        </div>
    </form>
</div>

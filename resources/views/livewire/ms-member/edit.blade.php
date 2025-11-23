<div class="space-y-6">
    <div>
        <flux:heading size="lg">Edit Member</flux:heading>
        <flux:text class="mt-2">Update member information</flux:text>
    </div>

    @if($id && $member)
    <form wire:submit="update({{ $id }})" class="space-y-6">
                <flux:input 
                    wire:model="name" label="Name" type="text" placeholder="Enter member name" />
                @error('name') <flux:error>{{ $message }}</flux:error> @enderror

                <flux:input 
                    wire:model="email" label="Email" placeholder="email@example.com" />
                @error('email') <flux:error>{{ $message }}</flux:error> @enderror

                <flux:input 
                    wire:model="phone" label="Phone" placeholder="Enter phone number (numbers only, 9-13 digits)" />
                @error('phone') <flux:error>{{ $message }}</flux:error> @enderror

                <flux:textarea 
                    wire:model="address" label="Address" placeholder="Enter address" rows="3" />
                @error('address') <flux:error>{{ $message }}</flux:error> @enderror

        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button variant="primary" type="submit">Update Member</flux:button>
        </div>
    </form>
    @else
    <div class="text-center py-4">
        <flux:text>Loading...</flux:text>
    </div>
    @endif
</div>

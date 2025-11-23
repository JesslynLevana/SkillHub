<div class="space-y-6">
    <div>
        <flux:heading size="lg">Class Details</flux:heading>
        <flux:text class="mt-2">View class information</flux:text>
    </div>

    @if($details)
    <div class="space-y-4">
                <div>
                    <flux:text class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">Class Name</flux:text>
                    <flux:text class="mt-1">{{ $details->name }}</flux:text>
                </div>

                <div>
                    <flux:text class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">Description</flux:text>
                    <flux:text class="mt-1">{{ $details->description ?? '-' }}</flux:text>
                </div>

                <div>
                    <flux:text class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">Instructor</flux:text>
                    <flux:text class="mt-1">{{ $details->instructor }}</flux:text>
                </div>
    </div>

    <div class="flex gap-2">
        <flux:spacer />
        <flux:modal.close>
            <flux:button variant="ghost">Close</flux:button>
        </flux:modal.close>
        <button 
            type="button"
            wire:click="openEditModal({{ $details->id }})"
            class="px-4 py-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors"
        >
            Edit
        </button>
    </div>
    @else
    <div class="text-center py-4">
        <flux:text>Loading...</flux:text>
    </div>
    @endif
</div>

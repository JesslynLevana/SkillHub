<div>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading>Enroll Member to Multiple Classes</flux:heading>
                <flux:subheading>Select a member and multiple classes</flux:subheading>
            </div>
            <flux:button variant="ghost" :href="route('enrollments.index')" wire:navigate>
                Back to List
            </flux:button>
        </div>

        @if (session()->has('message'))
            <div class="p-4 rounded-lg bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="p-4 rounded-lg bg-red-100 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6">
            <form wire:submit="storeMultiple" class="space-y-6">
                <flux:select wire:model="member_id" :label="__('Member')" required>
                    <option value="">Select a member</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </flux:select>
                @error('member_id') <flux:error>{{ $message }}</flux:error> @enderror

                <div>
                    <flux:text class="mb-2 text-sm font-semibold">Select Classes</flux:text>
                    <div class="space-y-2 max-h-60 overflow-y-auto border rounded-lg p-2">
                        @foreach ($classes as $class)
                            <label class="flex items-center space-x-2 p-2 rounded hover:bg-zinc-100 dark:hover:bg-zinc-700 cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    wire:model="class_ids" 
                                    value="{{ $class->id }}"
                                    class="rounded"
                                >
                                <span class="text-sm">{{ $class->name }} - {{ $class->instructor }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @error('class_ids') <flux:error>{{ $message }}</flux:error> @enderror

                <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                    <flux:button variant="ghost" type="button" :href="route('enrollments.index')" wire:navigate>
                        Cancel
                    </flux:button>
                    <flux:button variant="primary" type="submit">Enroll</flux:button>
                </div>
            </form>
        </div>
    </div>
</div>




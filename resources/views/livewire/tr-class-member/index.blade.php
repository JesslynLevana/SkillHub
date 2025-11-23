<div>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading>Enrollment Management</flux:heading>
                <flux:subheading>Manage member enrollments to classes</flux:subheading>
            </div>
            <div class="flex gap-2">
                <flux:button variant="primary" icon="plus" :href="route('enrollments.create')" wire:navigate>
                    Enroll Member
                </flux:button>
                <flux:button variant="primary" icon="plus" :href="route('enrollments.create-multiple')" wire:navigate>
                    Enroll Multiple Classes
                </flux:button>
            </div>
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

        {{-- navigation tabs --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6">
            <div class="flex gap-2 border-b border-zinc-200 dark:border-zinc-700">
                <button 
                    wire:click="$set('view_mode', 'member_classes')"
                    class="px-4 py-2 text-sm font-medium transition-colors {{ $view_mode === 'member_classes' ? 'border-b-2 border-primary-500 text-primary-600 dark:text-primary-400' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100' }}"
                >
                    View Member Classes
                </button>
                <button 
                    wire:click="$set('view_mode', 'class_members')"
                    class="px-4 py-2 text-sm font-medium transition-colors {{ $view_mode === 'class_members' ? 'border-b-2 border-primary-500 text-primary-600 dark:text-primary-400' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100' }}"
                >
                    View Class Members
                </button>
            </div>
        </div>

        {{-- view member-classes --}}
        @if ($view_mode === 'member_classes')
            @include('livewire.tr-class-member.member-classes')
        @endif

        {{-- view ckass-members --}}
        @if ($view_mode === 'class_members')
            @include('livewire.tr-class-member.class-members')
        @endif
    </div>

    {{-- confirm unenroll --}}
    <flux:modal name="confirm-unenroll" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Unenroll Member?</flux:heading>
                <flux:text class="mt-2">
                    You're about to unenroll this member from the class.<br>
                    This action cannot be reversed.
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="unenroll" variant="danger">Unenroll</flux:button>
            </div>
        </div>
    </flux:modal>
</div>


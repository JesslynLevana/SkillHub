<div>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading>Member Management</flux:heading>
                <flux:subheading>Manage all members in SkillHub</flux:subheading>
            </div>
            <flux:modal.trigger name="create-member">
                <flux:button variant="primary" icon="plus" wire:click="openCreateModal">
                    Add New Member
                </flux:button>
            </flux:modal.trigger>
        </div>

        @if (session()->has('message'))
            <div class="p-4 rounded-lg bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200">
                {{ session('message') }}
            </div>
        @endif

        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-zinc-200 dark:border-zinc-700">
                            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Phone</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($members as $index => $member)
                            <tr class="border-b border-zinc-200 dark:border-zinc-700">
                                <td class="px-4 py-3">{{ ($members->currentPage() - 1) * $members->perPage() + $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $member->name }}</td>
                                <td class="px-4 py-3">{{ $member->email ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $member->phone ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <button 
                                            type="button"
                                            wire:key="detail-btn-{{ $member->id }}"
                                            wire:click="openDetailModal('{{ $member->id }}')" 
                                            class="px-3 py-1.5 text-sm font-medium rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors"
                                        >
                                            Detail
                                        </button>
                                        <button 
                                            type="button"
                                            wire:key="edit-btn-{{ $member->id }}"
                                            wire:click="openEditModal('{{ $member->id }}')" 
                                            class="px-3 py-1.5 text-sm font-medium rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-colors"
                                        >
                                            Edit
                                        </button>
                                        <flux:modal.trigger name="delete-member">
                                            <button 
                                                type="button"
                                                wire:click="delete_confirmation({{ $member->id }})" 
                                                title="Delete this member"
                                                class="px-3 py-1.5 text-sm font-medium rounded-lg bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300 hover:bg-pink-200 dark:hover:bg-pink-900/50 transition-colors cursor-pointer"
                                            >
                                                Delete
                                            </button>
                                        </flux:modal.trigger>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-zinc-500">
                                    No members found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $members->links() }}
            </div>
        </div>
    </div>

    <flux:modal name="delete-member" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Member?</flux:heading>
                <flux:text class="mt-2">
                    You're about to delete this member.<br>
                    This action cannot be reversed. All enrollments associated with this member will also be deleted.
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="delete({{ $id }})" variant="danger">Delete Member</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="create-member" class="min-w-[28rem]">
        <div wire:key="create-member-form">
            @include('livewire.ms-member.create')
        </div>
    </flux:modal>

    <flux:modal name="edit-member" class="min-w-[28rem]">
        @if($id)
            <div wire:key="edit-member-{{ $id }}">
                @include('livewire.ms-member.edit')
            </div>
        @endif
    </flux:modal>

    <flux:modal name="detail-member" class="min-w-[28rem]">
        @if($details)
            <div wire:key="detail-member-{{ $details->id }}">
                @include('livewire.ms-member.detail')
            </div>
        @endif
    </flux:modal>
</div>


<div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6">
    <div class="space-y-6">
        {{-- select ato filter berdasar member --}}
        <div>
            <flux:select wire:model.live="filter_member_id" :label="__('Filter by Member')">
                <option value="">All Members</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </flux:select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-zinc-200 dark:border-zinc-700">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Member Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Enrolled Classes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allMembersWithClasses as $index => $member)
                        <tr class="border-b border-zinc-200 dark:border-zinc-700">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $member->name }}</td>
                            <td class="px-4 py-3">
                                @if($member->classes->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($member->classes as $class)
                                            <div class="flex items-center justify-between gap-2">
                                                <span>{{ $class->name }} ({{ $class->instructor }})</span>
                                                <flux:modal.trigger name="confirm-unenroll">
                                                    <button 
                                                        type="button"
                                                        wire:click="unenroll_confirmation({{ $member->id }}, {{ $class->id }})"
                                                        class="px-3 py-1.5 text-sm font-medium rounded-lg bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300 hover:bg-pink-200 dark:hover:bg-pink-900/50 transition-colors cursor-pointer"
                                                    >
                                                        Unenroll
                                                    </button>
                                                </flux:modal.trigger>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-zinc-500">No classes enrolled</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-zinc-500">
                                No members found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

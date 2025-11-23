<div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6">
    <div class="space-y-6">
        {{-- select/ filter berdasar class --}}
        <div>
            <flux:select wire:model.live="filter_class_id" :label="__('Filter by Class')">
                <option value="">All Classes</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }} - {{ $class->instructor }}</option>
                @endforeach
            </flux:select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-zinc-200 dark:border-zinc-700">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Class Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Instructor</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Enrolled Members</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allClassesWithMembers as $index => $class)
                        <tr class="border-b border-zinc-200 dark:border-zinc-700">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $class->name }}</td>
                            <td class="px-4 py-3">{{ $class->instructor }}</td>
                            <td class="px-4 py-3">
                                @if($class->members->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($class->members as $member)
                                            <div class="flex items-center justify-between gap-2">
                                                <span>{{ $member->name }} ({{ $member->email ?? 'No email' }})</span>
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
                                    <span class="text-zinc-500">No members enrolled</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-zinc-500">
                                No classes found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

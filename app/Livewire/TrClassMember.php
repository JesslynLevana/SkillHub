<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MsMember;
use App\Models\MsClass;
use App\Models\TrClassMember as Transaction;
use Flux\Flux;

class TrClassMember extends Component
{
    use WithPagination;

    public $member_id = null;
    public $class_id = null;
    public $class_ids = [];
    public $filter_member_id = null;
    public $filter_class_id = null;
    public $view_mode = 'member_classes';
    public $action = 'index'; 
    public $unenroll_member_id = null;
    public $unenroll_class_id = null;

    public function mount($action = 'index')
    {
        $routeName = request()->route()->getName();
        
        if ($routeName === 'enrollments.create') {
            $this->action = 'create';
        } elseif ($routeName === 'enrollments.create-multiple') {
            $this->action = 'create-multiple';
        } else {
            $this->action = 'index';
        }
    }

    public function layout()
    {
        return 'components.layouts.app';
    }

    public function render()
    {
        $members = MsMember::orderBy('name', 'asc')->get();
        $classes = MsClass::orderBy('name', 'asc')->get();
        
        if ($this->action === 'create') {
            return view('livewire.tr-class-member.create', [
                'members' => $members,
                'classes' => $classes,
            ]);
        } elseif ($this->action === 'create-multiple') {
            return view('livewire.tr-class-member.create-multiple', [
                'members' => $members,
                'classes' => $classes,
            ]);
        }

        $allMembersWithClasses = MsMember::with('classes')->orderBy('name', 'asc')->get();
        
        $allClassesWithMembers = MsClass::with('members')->orderBy('name', 'asc')->get();
        
        if ($this->view_mode === 'member_classes') {
            if ($this->filter_member_id) {
                $allMembersWithClasses = $allMembersWithClasses->filter(function($member) {
                    return $member->id == $this->filter_member_id;
                });
            }
        } elseif ($this->view_mode === 'class_members') {
            if ($this->filter_class_id) {
                $allClassesWithMembers = $allClassesWithMembers->filter(function($class) {
                    return $class->id == $this->filter_class_id;
                });
            }
        }

        return view('livewire.tr-class-member.index', [
            'members' => $members,
            'classes' => $classes,
            'allMembersWithClasses' => $allMembersWithClasses,
            'allClassesWithMembers' => $allClassesWithMembers,
        ]);
    }

    public function store()
    {
        $this->validate([
            'member_id' => 'required|exists:ms_members,id',
            'class_id' => 'required|exists:ms_classes,id',
        ]);

        $member = MsMember::find($this->member_id);

        if ($member->classes()->where('ms_classes.id', $this->class_id)->exists()) {
            $this->addError('class_id', 'Member is already enrolled in this class!');
            return;
        }

        $member->classes()->attach($this->class_id);

        session()->flash('message', 'Member enrolled successfully!');
        return $this->redirect(route('enrollments.index'), navigate: true);
    }

    public function storeMultiple()
    {
        $this->validate([
            'member_id' => 'required|exists:ms_members,id',
            'class_ids' => 'required|array|min:1',
            'class_ids.*' => 'exists:ms_classes,id',
        ]);

        $member = MsMember::find($this->member_id);
        
        $newClasses = collect($this->class_ids)->filter(function ($classId) use ($member) {
            return !$member->classes()->where('ms_classes.id', $classId)->exists();
        });

        if ($newClasses->isEmpty()) {
            $this->addError('class_ids', 'Member is already enrolled in all selected classes!');
            return;
        }

        $member->classes()->attach($newClasses->toArray());

        session()->flash('message', 'Member enrolled in ' . $newClasses->count() . ' class(es) successfully!');
        return $this->redirect(route('enrollments.index'), navigate: true);
    }

    public function unenroll_confirmation($memberId, $classId)
    {
        $this->unenroll_member_id = $memberId;
        $this->unenroll_class_id = $classId;
    }

    public function unenroll()
    {
        if (!$this->unenroll_member_id || !$this->unenroll_class_id) {
            return;
        }

        $member = MsMember::find($this->unenroll_member_id);
        if ($member) {
            $member->classes()->detach($this->unenroll_class_id);
        }

        $this->unenroll_member_id = null;
        $this->unenroll_class_id = null;
        session()->flash('message', 'Member unenrolled successfully!');
        $this->dispatch('modal-close', name: 'confirm-unenroll');
    }
}

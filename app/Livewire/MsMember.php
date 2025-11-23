<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MsMember as MasterMember;
use Livewire\Attributes\Layout;
use Flux\Flux;

class MsMember extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $phone;
    public $address;
    public $id;
    public $member;
    public $details;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|numeric|digits_between:9,13',
        'address' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'name.required' => 'Name is required.',
        'name.max' => 'Name must not exceed 255 characters.',
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.max' => 'Email must not exceed 255 characters.',
        'phone.required' => 'Phone number is required.',
        'phone.numeric' => 'Phone number must be in numbers only',
        'phone.digits_between' => 'Phone number must be between 9 and 13 digits.',
        'address.max' => 'Address must not exceed 500 characters.',
    ];

    public function openCreateModal()
    {
        $this->reset(['name', 'email', 'phone', 'address', 'id', 'member']);
        $this->resetErrorBag();
        $this->dispatch('modal-show', name: 'create-member');
    }

    public function openEditModal($id)
    {
        // tutup dl modal detail kalau kebuka
        $this->dispatch('modal-close', name: 'detail-member');

        $this->id = (int) $id;
        $this->edit($this->id);
        $this->resetErrorBag();

        $this->dispatch('modal-show', name: 'edit-member');
    }

    public function openDetailModal($id)
    {
        $this->id = (int) $id;
        $this->details = MasterMember::with('classes')->findOrFail($this->id);

        $this->dispatch('modal-show', name: 'detail-member');
    }

    public function render()
    {
        $members = MasterMember::orderBy('id', 'asc')->paginate(10);
        // dd($members);
        return view('livewire.ms-member.index', ['members' => $members]);
    }

    public function store()
    {
        $validated = $this->validate();

        if (MasterMember::where('email', $this->email)->exists()) {
            $this->addError('email', 'This email already exists.');
            return;
        }

        if (MasterMember::where('phone', $this->phone)->exists()) {
            $this->addError('phone', 'This phone number already exists.');
            return;
        }

        if (
            MasterMember::where('name', $this->name)
                ->where('email', $this->email)
                ->where('phone', $this->phone)
                ->where('address', $this->address)
                ->exists()
        ) {
            $this->addError('name', 'This member already exists.');
            return;
        }

        $member = MasterMember::create($validated);

        $perPage = 10;
        $position = MasterMember::where('id', '<=', $member->id)->count();
        $page = ceil($position / $perPage);
        $this->setPage($page);

        session()->flash('message', 'New Member added!');
        $this->dispatch('modal-close', name: 'create-member');
        $this->reset(['name', 'email', 'phone', 'address']);
    }

    public function edit($id)
    {
        $this->id = $id;
        $this->member = MasterMember::findOrFail($id);
        $this->name = $this->member->name;
        $this->email = $this->member->email;
        $this->phone = $this->member->phone;
        $this->address = $this->member->address;
    }

    public function update($id)
    {
        $this->id = $id;
        $this->member = MasterMember::findOrFail($id);

        $validated = $this->validate();

        if (
            MasterMember::where('name', $this->name)
                ->where('email', $this->email)
                ->where('phone', $this->phone)
                ->where('address', $this->address)
                ->where('id', '!=', $this->id)
                ->exists()
        ) {
            $this->addError('name', 'This member already exists.');
            return;
        }

        $this->member->update($validated);

        $perPage = 10;
        $position = MasterMember::where('id', '<=', $id)->count();
        $page = ceil($position / $perPage);
        $this->setPage($page);

        session()->flash('message', 'Member data updated!');
        $this->dispatch('modal-close', name: 'edit-member');
    }

    public function delete_confirmation($id)
    {
        $this->id = $id;
    }

    public function delete($id)
    {
        $member = MasterMember::findOrFail($id);

        // Hapus relasi dulu
        $member->classes()->detach();

        // Hapus member
        $member->delete();

        $total = MasterMember::count();
        $perPage = 10;
        $lastPage = ceil($total / $perPage);
        $this->setPage($lastPage);

        session()->flash('message', 'Member data deleted!');
        $this->dispatch('modal-close', name: 'delete-member');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MsClass as MasterClass;
use Livewire\Attributes\Layout;
use Flux\Flux;

class MsClass extends Component
{
    use WithPagination;

    public $name;
    public $description;
    public $instructor;
    public $id;
    public $class;
    public $details;

    public function openCreateModal()
    {
        $this->reset(['name', 'description', 'instructor', 'id', 'class']);
        
        // buang error msg kalau sblmnya ada ngethrow error dari validation
        $this->resetErrorBag();
        $this->dispatch('modal-show', name: 'create-class');
    }

    public function openEditModal($id)
    {
        // tutup modal detail kalau kebuka
        $this->dispatch('modal-close', name: 'detail-class');
        
        $this->id = (int) $id;
        $this->edit($this->id);
        $this->resetErrorBag();
        
        $this->dispatch('modal-show', name: 'edit-class');
    }

    public function openDetailModal($id)
    {
        $this->id = (int) $id;
        $this->details = MasterClass::with('members')->findOrFail($this->id);
        $this->dispatch('modal-show', name: 'detail-class');
    }

    public function render()
    {
        $classes = MasterClass::orderBy('id', 'asc')->paginate(10);
        return view('livewire.ms-class.index', ['classes' => $classes]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor' => 'required|string|max:255',
        ],[
            'name.required' => 'Name can not be empty',
            'instructor.required' => 'Instructor field must be filled.'
        ]);

        if (
            MasterClass::where('name', $this->name)
                ->where('instructor', $this->instructor)
                ->exists()
        ) {
            $this->addError('instructor', 'This combination of class name and the instructor already exists.');
            return;
        }

        $class = MasterClass::create([
            'name' => $this->name,
            'description' => $this->description,
            'instructor' => $this->instructor,
        ]);

        $perPage = 10;
        $position = MasterClass::where('id', '<=', $class->id)->count();
        $page = ceil($position / $perPage);
        $this->setPage($page);

        session()->flash('message', 'New Class added!');
        $this->dispatch('modal-close', name: 'create-class');
        $this->reset(['name', 'description', 'instructor']);
    }

    public function edit($id)
    {
        $this->id = $id;
        $this->class = MasterClass::findOrFail($id);
        $this->name = $this->class->name;
        $this->description = $this->class->description;
        $this->instructor = $this->class->instructor;
    }

    public function update($id)
    {
        $this->id = $id;
        $this->class = MasterClass::findOrFail($id);

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor' => 'required|string|max:255',
        ]);

        if (
            MasterClass::where('name', $this->name)
                ->where('instructor', $this->instructor)
                ->where('id', '!=', $this->id)
                ->exists()
        ) {
            $this->addError('instructor', 'This combination of class name and the instructor already exists.');
            return;
        }

        $this->class->update($validated);

        $perPage = 10;
        $position = MasterClass::where('id', '<=', $id)->count();
        $page = ceil($position / $perPage);
        $this->setPage($page);

        session()->flash('message', 'Class data updated!');
        $this->dispatch('modal-close', name: 'edit-class');
    }

    public function delete_confirmation($id)
    {
        $this->id = $id;
    }

    public function delete($id)
    {
        $class = MasterClass::findOrFail($id);

        // hapus relasi ke member dulu
        $class->members()->detach();

        // baru hapus classnya
        $class->delete();

        $total = MasterClass::count();
        $perPage = 10;
        $lastPage = ceil($total / $perPage);
        $this->setPage($lastPage);

        session()->flash('message', 'Class data deleted!');
        $this->dispatch('modal-close', name: 'delete-class');
    }
}

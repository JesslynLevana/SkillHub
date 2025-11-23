<?php

use App\Livewire\MsClass;
use App\Models\MsClass as MasterClass;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can render class index page', function () {
    Livewire::test(MsClass::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.ms-class.index');
});

test('can create a new class', function () {
    Livewire::test(MsClass::class)
        ->set('name', 'Web Development')
        ->set('description', 'Learn web development')
        ->set('instructor', 'John Doe')
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('modal-close', name: 'create-class');

    $this->assertDatabaseHas('ms_classes', [
        'name' => 'Web Development',
        'description' => 'Learn web development',
        'instructor' => 'John Doe',
    ]);
});

test('validates required fields when creating class', function () {
    Livewire::test(MsClass::class)
        ->set('name', '')
        ->set('instructor', '')
        ->call('store')
        ->assertHasErrors(['name', 'instructor']);
});

test('prevents duplicate class name and instructor combination', function () {
    MasterClass::factory()->create([
        'name' => 'Web Development',
        'instructor' => 'John Doe',
    ]);

    Livewire::test(MsClass::class)
        ->set('name', 'Web Development')
        ->set('instructor', 'John Doe')
        ->set('description', 'Different description')
        ->call('store')
        ->assertHasErrors(['instructor'])
        ->assertSee('This combination of class name and the instructor already exists.');
});

test('can update an existing class', function () {
    $class = MasterClass::factory()->create([
        'name' => 'Web Development',
        'instructor' => 'John Doe',
    ]);

    Livewire::test(MsClass::class)
        ->call('edit', $class->id)
        ->set('name', 'Advanced Web Development')
        ->set('instructor', 'Jane Doe')
        ->call('update', $class->id)
        ->assertHasNoErrors()
        ->assertDispatched('modal-close', name: 'edit-class');

    $this->assertDatabaseHas('ms_classes', [
        'id' => $class->id,
        'name' => 'Advanced Web Development',
        'instructor' => 'Jane Doe',
    ]);
});

test('can delete a class', function () {
    $class = MasterClass::factory()->create();

    Livewire::test(MsClass::class)
        ->call('delete', $class->id)
        ->assertDispatched('modal-close', name: 'delete-class');

    $this->assertDatabaseMissing('ms_classes', [
        'id' => $class->id,
    ]);
});

test('can open create modal', function () {
    Livewire::test(MsClass::class)
        ->set('name', 'Test Class')
        ->set('instructor', 'Test Instructor')
        ->call('openCreateModal')
        ->assertSet('name', null)
        ->assertSet('description', null)
        ->assertSet('instructor', null)
        ->assertDispatched('modal-show', name: 'create-class');
});

test('can open edit modal and load class data', function () {
    $class = MasterClass::factory()->create([
        'name' => 'Web Development',
        'description' => 'Learn web development',
        'instructor' => 'John Doe',
    ]);

    Livewire::test(MsClass::class)
        ->call('openEditModal', $class->id)
        ->assertSet('id', $class->id)
        ->assertSet('name', 'Web Development')
        ->assertSet('description', 'Learn web development')
        ->assertSet('instructor', 'John Doe')
        ->assertDispatched('modal-close', name: 'detail-class')
        ->assertDispatched('modal-show', name: 'edit-class');
});

test('can open detail modal', function () {
    $class = MasterClass::factory()->create();

    Livewire::test(MsClass::class)
        ->call('openDetailModal', $class->id)
        ->assertSet('id', $class->id)
        ->assertSet('details.id', $class->id)
        ->assertDispatched('modal-show', name: 'detail-class');
});




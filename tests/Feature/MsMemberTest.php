<?php

use App\Livewire\MsMember;
use App\Models\MsMember as MasterMember;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can render member index page', function () {
    Livewire::test(MsMember::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.ms-member.index');
});

test('can create a new member', function () {
    Livewire::test(MsMember::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@example.com')
        ->set('phone', '1234567890')
        ->set('address', '123 Main St')
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('modal-close', name: 'create-member');

    $this->assertDatabaseHas('ms_members', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
        'address' => '123 Main St',
    ]);
});

test('validates required fields when creating member', function () {
    Livewire::test(MsMember::class)
        ->set('name', '')
        ->set('email', '')
        ->set('phone', '')
        ->call('store')
        ->assertHasErrors(['name', 'email', 'phone']);
});

test('validates email format when creating member', function () {
    Livewire::test(MsMember::class)
        ->set('name', 'John Doe')
        ->set('email', 'invalid-email')
        ->set('phone', '1234567890')
        ->call('store')
        ->assertHasErrors(['email']);
});

test('validates phone number format when creating member', function () {
    Livewire::test(MsMember::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@example.com')
        ->set('phone', '12345') // too short (less than 9 digits)
        ->call('store')
        ->assertHasErrors(['phone']);

    Livewire::test(MsMember::class)
        ->set('name', 'John Doe')
        ->set('email', 'john2@example.com')
        ->set('phone', '12345678901234') // too long (more than 13 digits)
        ->call('store')
        ->assertHasErrors(['phone']);
});

test('prevents duplicate email when creating member', function () {
    MasterMember::factory()->create(['email' => 'existing@example.com']);

    Livewire::test(MsMember::class)
        ->set('name', 'John Doe')
        ->set('email', 'existing@example.com')
        ->set('phone', '1234567890')
        ->set('address', '123 Main St')
        ->call('store')
        ->assertHasErrors(['email'])
        ->assertSee('This email already exists.');
});

test('prevents duplicate phone when creating member', function () {
    MasterMember::factory()->create(['phone' => '1234567890']);

    Livewire::test(MsMember::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@example.com')
        ->set('phone', '1234567890')
        ->set('address', '123 Main St')
        ->call('store')
        ->assertHasErrors(['phone'])
        ->assertSee('This phone number already exists.');
});

test('can update an existing member', function () {
    $member = MasterMember::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
    ]);

    Livewire::test(MsMember::class)
        ->call('edit', $member->id)
        ->set('name', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->call('update', $member->id)
        ->assertHasNoErrors()
        ->assertDispatched('modal-close', name: 'edit-member');

    $this->assertDatabaseHas('ms_members', [
        'id' => $member->id,
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
    ]);
});

test('can delete a member', function () {
    $member = MasterMember::factory()->create();

    Livewire::test(MsMember::class)
        ->call('delete', $member->id)
        ->assertDispatched('modal-close', name: 'delete-member');

    $this->assertDatabaseMissing('ms_members', [
        'id' => $member->id,
    ]);
});

test('can open create modal', function () {
    Livewire::test(MsMember::class)
        ->set('name', 'Test')
        ->set('email', 'test@example.com')
        ->call('openCreateModal')
        ->assertSet('name', null)
        ->assertSet('email', null)
        ->assertSet('phone', null)
        ->assertSet('address', null)
        ->assertDispatched('modal-show', name: 'create-member');
});

test('can open edit modal and load member data', function () {
    $member = MasterMember::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
        'address' => '123 Main St',
    ]);

    Livewire::test(MsMember::class)
        ->call('openEditModal', $member->id)
        ->assertSet('id', $member->id)
        ->assertSet('name', 'John Doe')
        ->assertSet('email', 'john@example.com')
        ->assertSet('phone', '1234567890')
        ->assertSet('address', '123 Main St')
        ->assertDispatched('modal-close', name: 'detail-member')
        ->assertDispatched('modal-show', name: 'edit-member');
});

test('can open detail modal', function () {
    $member = MasterMember::factory()->create();

    Livewire::test(MsMember::class)
        ->call('openDetailModal', $member->id)
        ->assertSet('id', $member->id)
        ->assertSet('details.id', $member->id)
        ->assertDispatched('modal-show', name: 'detail-member');
});


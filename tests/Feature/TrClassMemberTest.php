<?php

use App\Livewire\TrClassMember;
use App\Models\MsMember;
use App\Models\MsClass;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can render enrollment index page', function () {
    Livewire::test(TrClassMember::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.tr-class-member.index');
});

test('can enroll a member to a class', function () {
    $member = MsMember::factory()->create();
    $class = MsClass::factory()->create();

    Livewire::test(TrClassMember::class)
        ->set('member_id', $member->id)
        ->set('class_id', $class->id)
        ->call('store')
        ->assertHasNoErrors()
        ->assertRedirect(route('enrollments.index'));

    $this->assertDatabaseHas('tr_class_members', [
        'ms_member_id' => $member->id,
        'ms_class_id' => $class->id,
    ]);

    // Verify relationship
    expect($member->fresh()->classes)->toHaveCount(1);
    expect($member->fresh()->classes->first()->id)->toBe($class->id);
});

test('validates required fields when enrolling member', function () {
    Livewire::test(TrClassMember::class)
        ->set('member_id', null)
        ->set('class_id', null)
        ->call('store')
        ->assertHasErrors(['member_id', 'class_id']);
});

test('validates member exists when enrolling', function () {
    $class = MsClass::factory()->create();

    Livewire::test(TrClassMember::class)
        ->set('member_id', 99999) // non-existent member
        ->set('class_id', $class->id)
        ->call('store')
        ->assertHasErrors(['member_id']);
});

test('validates class exists when enrolling', function () {
    $member = MsMember::factory()->create();

    Livewire::test(TrClassMember::class)
        ->set('member_id', $member->id)
        ->set('class_id', 99999) // non-existent class
        ->call('store')
        ->assertHasErrors(['class_id']);
});

test('can enroll member to multiple classes', function () {
    $member = MsMember::factory()->create();
    $class1 = MsClass::factory()->create();
    $class2 = MsClass::factory()->create();
    $class3 = MsClass::factory()->create();

    Livewire::test(TrClassMember::class)
        ->set('member_id', $member->id)
        ->set('class_ids', [$class1->id, $class2->id, $class3->id])
        ->call('storeMultiple')
        ->assertHasNoErrors()
        ->assertRedirect(route('enrollments.index'));

    // Verify all classes are enrolled
    expect($member->fresh()->classes)->toHaveCount(3);
    expect($member->fresh()->classes->pluck('id')->toArray())
        ->toContain($class1->id, $class2->id, $class3->id);
});

test('validates required fields when enrolling to multiple classes', function () {
    Livewire::test(TrClassMember::class)
        ->set('member_id', null)
        ->set('class_ids', [])
        ->call('storeMultiple')
        ->assertHasErrors(['member_id', 'class_ids']);
});

test('validates class_ids is array when enrolling to multiple classes', function () {
    $member = MsMember::factory()->create();

    Livewire::test(TrClassMember::class)
        ->set('member_id', $member->id)
        ->set('class_ids', 'not-an-array')
        ->call('storeMultiple')
        ->assertHasErrors(['class_ids']);
});

test('skips already enrolled classes when enrolling to multiple', function () {
    $member = MsMember::factory()->create();
    $class1 = MsClass::factory()->create();
    $class2 = MsClass::factory()->create();
    $class3 = MsClass::factory()->create();
    
    // Enroll to class1 first
    $member->classes()->attach($class1->id);

    // Try to enroll to all three (class1 already enrolled)
    Livewire::test(TrClassMember::class)
        ->set('member_id', $member->id)
        ->set('class_ids', [$class1->id, $class2->id, $class3->id])
        ->call('storeMultiple')
        ->assertHasNoErrors();

    // Should only have class2 and class3 added (class1 was skipped)
    expect($member->fresh()->classes)->toHaveCount(3);
});

test('can unenroll a member from a class', function () {
    $member = MsMember::factory()->create();
    $class = MsClass::factory()->create();
    
    // Enroll first
    $member->classes()->attach($class->id);
    expect($member->fresh()->classes)->toHaveCount(1);

    Livewire::test(TrClassMember::class)
        ->call('unenroll_confirmation', $member->id, $class->id)
        ->call('unenroll')
        ->assertDispatched('modal-close', name: 'confirm-unenroll')
        ->assertSet('unenroll_member_id', null)
        ->assertSet('unenroll_class_id', null);

    // Verify unenrolled
    expect($member->fresh()->classes)->toHaveCount(0);
    $this->assertDatabaseMissing('tr_class_members', [
        'ms_member_id' => $member->id,
        'ms_class_id' => $class->id,
    ]);
});

test('unenroll does nothing if member or class id is not set', function () {
    $member = MsMember::factory()->create();
    $class = MsClass::factory()->create();
    
    // Enroll first
    $member->classes()->attach($class->id);

    Livewire::test(TrClassMember::class)
        ->call('unenroll') // No confirmation set
        ->assertSet('unenroll_member_id', null)
        ->assertSet('unenroll_class_id', null);

    // Should still be enrolled
    expect($member->fresh()->classes)->toHaveCount(1);
});

test('can filter enrollments by member', function () {
    $member1 = MsMember::factory()->create(['name' => 'John Doe']);
    $member2 = MsMember::factory()->create(['name' => 'Jane Doe']);
    $class = MsClass::factory()->create();
    
    $member1->classes()->attach($class->id);
    $member2->classes()->attach($class->id);

    Livewire::test(TrClassMember::class)
        ->set('view_mode', 'member_classes')
        ->set('filter_member_id', $member1->id)
        ->call('$refresh')
        ->assertSet('filter_member_id', $member1->id);
});

test('can filter enrollments by class', function () {
    $member = MsMember::factory()->create();
    $class1 = MsClass::factory()->create(['name' => 'Web Development']);
    $class2 = MsClass::factory()->create(['name' => 'Mobile Development']);
    
    $member->classes()->attach([$class1->id, $class2->id]);

    Livewire::test(TrClassMember::class)
        ->set('view_mode', 'class_members')
        ->set('filter_class_id', $class1->id)
        ->call('$refresh')
        ->assertSet('filter_class_id', $class1->id);
});


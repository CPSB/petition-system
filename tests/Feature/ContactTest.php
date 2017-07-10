<?php

namespace Tests\Feature;

use ActivismeBE\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testFrontEndForm()
    {
        $this->get(route('contact.index'))->assertStatus(200);
    }

    public function testFrontEndStoreNoValError()
    {
        $input['email']      = $this->faker->email;
        $input['first_name'] = $this->faker->firstname;
        $input['last_name']  = $this->faker->name;
        $input['message']    = $this->faker->name;
        $input['subject']    = $this->faker->name;

        $this->post(route('contact.store'), $input)
            ->assertStatus(302);

        $this->assertDatabaseHas('contacts', $input);
    }

    public function testFrontEndStoreWithValErr()
    {
        $this->post(route('contact.store'))
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    public function testContactBackendOk()
    {
        $this->actingAs($this->adminUser)
            ->seeIsAuthenticatedAs($this->adminUser)
            ->get(route('contact.backend.index'))
            ->assertStatus(200);
    }

    public function testContactBackendNoPerm()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->seeIsAuthenticatedAs($user)
            ->get(route('contact.backend.index'))
            ->assertStatus(403);
    }

    public function testContactBackendNotAuthencated()
    {
        $this->get(route('contact.backend.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}

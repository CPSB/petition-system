<?php

namespace Tests\Feature;

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
            ->assertStatus(302)
            ->assertSee(trans('contact.contact-store'));

        $this->assertDatabaseHas('contacts', $input);
    }

    public function testFrontEndStoreWithValErr()
    {
        $this->post(route('contact.store'))
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }
}

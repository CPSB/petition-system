<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountSettingsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testNotAuthencated()
    {
        $this->get(route('settings.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testAuthencated()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->get(route('settings.index'))
            ->assertStatus(200);
    }

    public function testChangeSettingsValidationErrors()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->post(route('settings.info'), [])
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    public function testChangeSettingsNoAuth()
    {
        $this->post(route('settings.info'), [])
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testChangeSettingsOk()
    {
        $old = ['name'  => $this->user->name, 'email' => $this->user->email];
        $new = ['name'  => 'Example name', 'email' => 'example@email.tld'];

        $this->assertDatabaseHas('users', $old);

        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->post(route('settings.info'), $new)
            ->assertStatus(302);

        $this->assertDatabaseHas('users', $new);
        $this->assertDatabaseMissing('users', $old);
    }

    public function testChangePasswordNoAuth()
    {
        $this->post(route('settings.security'), [])
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testChangePasswordValidationErrors()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->post(route('settings.security'))
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    public function testChangePasswordValidationOk()
    {
        $input = ['password' => 'password', 'password_confirmation' => 'password'];

        $this->assertDatabaseHas('users', ['password' => $this->user->password]);

        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->post(route('settings.security'), $input)
            ->assertStatus(302);

        $this->assertDatabaseMissing('users', ['password' => $this->user->password]);
    }
}

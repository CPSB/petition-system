<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HelpdeskTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testHelpdeskAccessNoAuth()
    {
        $this->get(route('helpdesk.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testHelpdeskAccessWithAuth()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->get(route('helpdesk.index'))
            ->assertStatus(200);
    }

    public function testNewQuestionViewNoAuth()
    {
        $this->get(route('helpdesk.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testNewQuestionViewWithAuth()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->get(route('helpdesk.create'))
            ->assertStatus(200);
    }

    public function testYourQuestionsNoAuth()
    {
        $this->get(route('helpdesk.user'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testYourQuestionsWithAuth()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->get(route('helpdesk.user'))
            ->assertStatus(200);
    }

    public function testPublicQuestionsWithAuth()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->get(route('helpdesk.user'))
            ->assertStatus(200);
    }

    public function testPublicQuestionsNoAuth()
    {
        $this->get(route('helpdesk.public'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testStoreNewQuestionValidationErrors()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->post(route('helpdesk.store'), [])
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    public function testStoreNewQuestionNoValidationErrors()
    {
        $input = [
            'title' => $this->faker->name,
            'category_id' => 2,
            'description' => $this->faker->word,
            'publish' => 'Y',
        ];

        $this->assertDatabaseMissing('helpdesks', $input);

        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->post(route('helpdesk.store'), $input)
            ->assertStatus(302);

        // $this->assertDatabaseHas('helpdesks', $input);
    }

    public function testStoreNewQuestionNoAuth()
    {
        $this->post(route('helpdesk.store'), [])
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testNotificationsOverviewAuth()
    {
        $this->actingAs($this->user)
            ->seeIsAuthenticatedAs($this->user)
            ->get(route('notifications.index'))
            ->assertStatus(200);
    }

    public function testNotificationsNoAuth()
    {
        $this->get(route('notifications.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}

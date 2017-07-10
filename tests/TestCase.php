<?php

namespace Tests;

use ActivismeBE\Permission;
use ActivismeBE\Role;
use ActivismeBE\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $faker;
    protected $adminUser;
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $user = factory(User::class)->create();
        $role = factory(Role::class)->create(['name' => 'Admin', 'guard_name' => 'web']);

        $this->faker     = Factory::create();

        $this->user      = $user;
        $this->adminUser = User::find($user->id)->assignRole($role->name);
    }
}

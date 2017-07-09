<?php

namespace Tests;

use ActivismeBE\Role;
use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $faker;

    public function setUp()
    {
        parent::setUp();

        factory(Role::class)->create(['name' => 'Admin']);

        $this->faker = Factory::create();
    }
}

<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getEnvironmentSetUp($app)
    {
        // $app['config']->set('cors.paths',['api/*', 'sanctum/csrf-cookie']);
        // $app['config']->set('cors.supports_credentials', true);
        // $app['config']->set('sanctum.stateful', 'localhost');
        // $app['config']->set('session.domain', 'localhost');
    }
}

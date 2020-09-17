<?php

use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TestCase extends BaseTestCase
{
    use DatabaseMigrations {
        runDatabaseMigrations as runMigration;
    }

    public function setUp(): void
    {
        parent::setUp();
    }

    public function runDatabaseMigrations()
    {
        $this->app->useDatabasePath(realpath(__DIR__) . '/_database');
        $this->runMigration();
    }
}

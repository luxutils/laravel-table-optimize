<?php

use Luxutils\Optimizer\Optimizer;
use Illuminate\Support\Facades\DB;

class MySqlTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.connections.mysql-test', [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'test'),
            'username' => env('DB_USERNAME', 'test'),
            'password' => env('DB_PASSWORD', 'test'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
        ]);
        $app['config']->set('database.default', 'mysql-test');
    }

    public function test_mysql_optimize()
    {
        $optimizer = new Optimizer('mysql-test', 'test');
        $optimizer->runOptimizer();
    }
}

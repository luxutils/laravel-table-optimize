<?php

namespace Luxutils\Optimizer\Optimizers;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class DBOptimizer
{
    public String $connection;
    public String $database;

    public function __construct(String $connection, String $database)
    {
        $this->connection = $connection;
        $this->database = $database;
    }

    /**
     * Exetuted before optimization.
     * @return void 
     */
    public function before(): void
    {
        Artisan::call('down');
    }

    /**
     * Executed after optimization.
     * @return void 
     */
    public function after(): void
    {
        Artisan::call('up');
    }

    /**
     * Optimization function. Add hooks and statements here. 
     * Should be implemented in class that extends
     * `Luxutils\Optimizer\Optimizers\DBOptimizer`.
     * @return void 
     * @throws \Exception 
     */
    public function optimize(): void
    {
        throw new \Exception("Please provide your own optimize() function!");
    }

    /**
     * Get selected connection.
     * @return ConnectionInterface 
     */
    public function getConnection(): ConnectionInterface
    {
        return DB::connection($this->connection);
    }

    /**
     * Run all optimization steps.
     * @return void 
     */
    public function run(): void
    {
        $this->before();
        try {
            $this->optimize();
        } catch (\Exception $e) {
        } finally {
            $this->after();
        }
    }
}

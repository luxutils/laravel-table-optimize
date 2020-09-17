<?php

namespace Luxutils\Optimizer;

use Illuminate\Support\Facades\DB;
use Luxutils\Optimizer\Exceptions\UnsupportedDriverException;
use Luxutils\Optimizer\Optimizers\DBOptimizer;
use Luxutils\Optimizer\Optimizers\MySqlOptimizer;

class Optimizer
{
    protected ?DBOptimizer $optimizer;

    protected ?String $driver;
    protected ?String $connection;
    protected ?String $database;

    public function __construct(String $connection = null, String $database = null)
    {
        $this->connection = $connection ?? $this->detectConnection();
        $this->database = $database ?? $this->detectConnection();

        $this->driver = $this->detectDriver();

        $this->optimizer = $this->createOptimizer($this->driver);
    }

    public function detectConnection(): ?String
    {
        return config('database.default');
    }

    public function detectDatabase(): ?String
    {
        return config('database.connections.' . $this->connection . '.database');
    }

    public function detectDriver(): ?String
    {
        $connectionDriver = config('database.connections.' . $this->connection . '.driver');
        $currentDriver = optional(DB::connection())->getPDO()->getAttribute(\PDO::ATTR_DRIVER_NAME);
        return $connectionDriver ?? $currentDriver;
    }

    public function createOptimizer(String $driver): DBOptimizer
    {
        switch ($driver) {
            case 'mysql':
                return new MySqlOptimizer($this->connection, $this->database);
            default:
                throw new UnsupportedDriverException('Unsupported driver: ' . $driver);
        }
    }

    public function runOptimizer()
    {
        $this->optimizer->run();
    }
}

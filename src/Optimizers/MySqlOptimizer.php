<?php

namespace Luxutils\Optimizer\Optimizers;

use Doctrine\DBAL\Connection;
use Illuminate\Support\Collection;

class MySqlOptimizer extends DBOptimizer
{
    public function getTables()
    {
        return optional($this->getConnection())->getDoctrineSchemaManager()->listTableNames();
    }

    public function optimize(): void
    {
        foreach ($this->getTables() as $table) {
            $this->getConnection()->statement('OPTIMIZE TABLE ?', [$table]);
        }
    }
}

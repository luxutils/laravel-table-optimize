<?php

namespace Luxutils\Optimizer\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Luxutils\Optimizer\Optimizer;
use Luxutils\Optimizer\Optimizers\DBOptimizer;

class OptimizeTables implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Optimizer $optimizer;

    public function __construct(String $connection = null)
    {
        $this->optimizer = new Optimizer($connection);
    }

    public function handle()
    {
        $this->optimizer->runOptimizer();
    }
}

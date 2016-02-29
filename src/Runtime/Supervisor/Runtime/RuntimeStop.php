<?php

namespace Kraken\Runtime\Supervisor\Runtime;

use Kraken\Runtime\Supervisor\SolverBase;
use Kraken\Supervisor\SolverInterface;
use Error;
use Exception;

class RuntimeStop extends SolverBase implements SolverInterface
{
    /**
     * @var string[]
     */
    protected $requires = [
        'origin'
    ];

    /**
     * @param Error|Exception $ex
     * @param mixed[] $params
     * @return mixed
     */
    protected function handler($ex, $params = [])
    {
        return $this->runtime->manager()->stopRuntime($params['origin']);
    }
}
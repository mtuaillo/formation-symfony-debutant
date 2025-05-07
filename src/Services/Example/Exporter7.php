<?php

namespace App\Services\Example;

use Psr\Log\LoggerInterface;

class Exporter7
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}

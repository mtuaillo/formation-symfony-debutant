<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class Exporter8
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}

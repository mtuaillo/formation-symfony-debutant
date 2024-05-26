<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

trait ExporterTrait
{
    private LoggerInterface $logger;

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}

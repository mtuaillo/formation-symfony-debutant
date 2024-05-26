<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

// Une classe abstraite ne peut être instanciée
abstract class AbstractExporter
{
    protected LoggerInterface $logger;

  	public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}

// Une classe finale ne peut être étendue
final class ChildExporter extends AbstractExporter
{
}

<?php

namespace App\Services;

class Exporter5
{
    private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function getLogger()
    {
        return $this->logger;
    }
}

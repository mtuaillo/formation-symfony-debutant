<?php

namespace App\Services\Example\Doctrine;

class Event
{
    public function __construct(
        private \DateTime $startsAt,
        private string $duration,
    ) {
    }

    public function getStartsAt(): \DateTime
    {
        return $this->startsAt;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }
}

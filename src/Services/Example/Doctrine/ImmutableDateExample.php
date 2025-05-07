<?php

namespace App\Services\Example\Doctrine;

class ImmutableDateExample
{
    public function dateTimeMustBeImmutable(): void
    {
        $event = new Event(new \DateTime('2025-04-14 14:00:00'), 'PT3H');

        $endsAt = $event->getStartsAt()->add(new \DateInterval($event->getDuration()));
        dump($endsAt); // 2025-04-14 17:00:00.0 UTC (+00:00)
        dump($event->getStartsAt()); // 2025-04-14 17:00:00.0 UTC (+00:00)
    }

    public function floatPrecision(): void
    {
        $a = 0.1 + 0.2;
        dump($a); // 0.3
        dump($a == 0.3); // false
        dump(number_format($a, 20)); // "0.30000000000000004441"
    }
}

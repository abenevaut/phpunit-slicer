<?php

namespace abenevaut\Infrastructure\App\Listeners;

use abenevaut\Infrastructure\App\Events\EventInterface;

abstract class ListenerAbstract
{
    abstract public function handle(EventInterface $event): void;
}

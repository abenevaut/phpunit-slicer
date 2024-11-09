<?php

namespace abenevaut\Infrastructure\App\Listeners;

abstract class ListenerAbstract
{
    abstract public function handle($event): void;
}

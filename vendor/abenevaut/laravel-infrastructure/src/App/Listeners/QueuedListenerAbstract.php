<?php

namespace abenevaut\Infrastructure\App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

abstract class QueuedListenerAbstract extends ListenerAbstract implements ShouldQueue
{
    use InteractsWithQueue;
}

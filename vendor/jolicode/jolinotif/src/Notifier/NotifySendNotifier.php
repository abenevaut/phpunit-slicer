<?php

/*
 * This file is part of the JoliNotif project.
 *
 * (c) Loïck Piera <pyrech@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Joli\JoliNotif\Notifier;

use Joli\JoliNotif\Notification;

/**
 * This notifier can be used on most Linux distributions, using the command notify-send.
 * This command is packaged in libnotify-bin.
 */
class NotifySendNotifier extends CliBasedNotifier
{
    public function getBinary(): string
    {
        return 'notify-send';
    }

    public function getPriority(): int
    {
        return static::PRIORITY_MEDIUM;
    }

    protected function getCommandLineArguments(Notification $notification): array
    {
        $arguments = [];

        if ($notification->getIcon()) {
            $arguments[] = '--icon';
            $arguments[] = $notification->getIcon();
        }

        if ($notification->getTitle()) {
            $arguments[] = $notification->getTitle();
        }

        $arguments[] = $notification->getBody();

        return $arguments;
    }
}

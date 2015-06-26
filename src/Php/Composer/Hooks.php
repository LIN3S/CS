<?php

/*
 * This file is part of the CHANGE-FOR-PROJECT-NAME project.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\Php\Composer;

use Composer\Script\Event;

class Hooks
{
    public static function checkHooks(Event $event)
    {
        $io = $event->getIO();
        $gitHook = @file_get_contents(__DIR__ . '/../../../.git/hooks/pre-commit');
        $resourceHook = @file_get_contents(__DIR__ . '/../../../Resources/hooks/pre-commit');

        $result = true;
        if ($gitHook !== $resourceHook) {
            $io->write(<<<EOT
<error>You, motherfucker, please, set up your hooks!</error> you only have to type the following two commands:
<info>rm -rf .git/hooks</info>
<info>ln -s ../Resources/hooks .git/hooks</info>
EOT
            );
            $result = false;
        }

        return $result;
    }
}

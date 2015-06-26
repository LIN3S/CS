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
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

class Hooks
{
    public static function addToProject(Event $event)
    {
        $io = $event->getIO();
        $fileSystem = new Filesystem();
        
        try {
            $fileSystem->symlink(
                __DIR__ . '/../../Resources/hooks/pre-commit',
                __DIR__ . '/../../../../../../.git/hooks/pre-commit',
                true
            );
        } catch (IOException $exception) {
            echo 'Something wrong happens during the symlink process: ';
            $io->write(sprintf('<error>%s</error>', $exception->getMessage()));
        }
    }
}

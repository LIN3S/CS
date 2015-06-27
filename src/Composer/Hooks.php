<?php

/*
 * This file is part of the Check Style package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CheckStyle\Composer;

use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;

class Hooks
{
    public static function addToProject()
    {
        $fileSystem = new Filesystem();

        try {
            $fileSystem->symlink(
                __DIR__ . '/../CheckStyle.php',
                __DIR__ . '/../../../../../.git/hooks/pre-commit',
                true
            );
        } catch (\Exception $exception) {
            echo 'Something wrong happens during the symlink process: ';
            echo sprintf('<error>%s</error>', $exception->getMessage());
        }
    }
}

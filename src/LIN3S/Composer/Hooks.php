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

final class Hooks
{
    /**
     * Static method that allows to create a hooks symlink
     * when Composer throws the install or update commands.
     */
    public static function addToProject()
    {
        $hooksDirectory = __DIR__ . '/../../../../../.git/hooks';
        $fileSystem = new Filesystem();

        try {
            if ($fileSystem->exists($hooksDirectory)) {
                $fileSystem->remove($hooksDirectory);
            }
            $fileSystem->symlink(__DIR__ . '/../Hooks', $hooksDirectory, true);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the symlink process: \n%s\n", $exception->getMessage());
        }
    }
}

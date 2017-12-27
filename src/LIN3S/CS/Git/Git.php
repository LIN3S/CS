<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace LIN3S\CS\Git;

use Symfony\Component\Process\Process;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class Git
{
    public static function committedFiles()
    {
        $output = [];
        $rc = 0;

        exec('git rev-parse --verify HEAD 2> /dev/null', $output, $rc);

        $against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';
        if (0 === $rc) {
            $against = 'HEAD';
        }

        exec("git diff-index --cached --name-status $against | egrep '^(A|M)' | awk '{print $2;}'", $output);

        return $output;
    }

    public static function addFiles(array $files, $rootDirectory = null)
    {
        foreach ($files as $file) {
            if (false === file_exists($file)) {
                continue;
            }
            $process = new Process(sprintf('git add %s', $file), $rootDirectory);
            $process->run();
        }

        return $files;
    }
}

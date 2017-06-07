<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CS\Git;

use Symfony\Component\Process\Process;

/**
 * Git class is an abstraction layer of Git command line
 * that provides some method to manage the committed files.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class Git
{
    /**
     * Gets all the files that are going to be committed.
     *
     * @return array
     */
    public static function committedFiles()
    {
        $output = [];
        $rc = 0;

        exec('git rev-parse --verify HEAD 2> /dev/null', $output, $rc);

        $against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';
        if ($rc == 0) {
            $against = 'HEAD';
        }

        exec("git diff-index --cached --name-status $against | egrep '^(A|M)' | awk '{print $2;}'", $output);

        return $output;
    }

    /**
     * Adds the given files to the Git stage.
     *
     * @param array       $files         The files to be added to the stage
     * @param string|null $rootDirectory The directory where the command is going to be execute
     *
     * @return array
     */
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

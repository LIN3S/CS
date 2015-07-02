<?php

/*
 * This file is part of the Check Style package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CheckStyle\Fetcher;

class GitFetcher
{
    /**
     * Static wrapper of getCommittedFiles method.
     *
     * @return array
     */
    public static function committedFiles()
    {
        return self::getCommittedFiles();
    }

    /**
     * Gets all the files that are going to be committed.
     *
     * @return array
     */
    public function getCommittedFiles()
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
}

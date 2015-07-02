<?php

/*
 * This file is part of the Check Style package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CheckStyle\Checker;

use LIN3S\CheckStyle\CheckStyle;
use LIN3S\CheckStyle\Error\Error;
use Symfony\Component\Process\ProcessBuilder;

final class Phpmd extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files, $rootDirectory = null)
    {
        $errors = [];
        foreach ($files as $file) {
            if (!preg_match(CheckStyle::PHP_FILES_IN_SRC, $file)) {
                continue;
            }

            $processBuilder = new ProcessBuilder(['php', 'bin/phpmd', $file, 'text', 'controversial']);
            $processBuilder->setWorkingDirectory($rootDirectory);
            $process = $processBuilder->getProcess();
            $process->run();

            if (!$process->isSuccessful()) {
                $errors[] = new Error(
                    $file,
                    sprintf('<error>%s</error>', trim($process->getErrorOutput())),
                    sprintf('<info>%s</info>', trim($process->getOutput()))
                );
            }
        }

        return $errors;
    }
}

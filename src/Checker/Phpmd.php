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

use LIN3S\CheckStyle\Error\Error;
use Symfony\Component\Process\ProcessBuilder;

final class Phpmd extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files = [], array $parameters = null)
    {
        $errors = [];
        foreach ($files as $file) {
            if (false === self::exist($file, $parameters['phpmd_path'], 'php')) {
                continue;
            }

            $processBuilder = new ProcessBuilder([
                'php', 'vendor/phpmd/phpmd/src/bin/phpmd', $file, 'text', implode(',', $parameters['phpmd_rules'])
            ]);
            $processBuilder->setWorkingDirectory($parameters['root_directory']);
            $process = $processBuilder->getProcess();
            $process->run();

            if (!$process->isSuccessful()) {
                $errors[] = new Error(
                    $file,
                    sprintf('<error>%s</error>', trim($process->getErrorOutput())),
                    sprintf('<error>%s</error>', trim($process->getOutput()))
                );
            }
        }

        return $errors;
    }
}

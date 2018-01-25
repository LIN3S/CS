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

namespace LIN3S\CS\Checker;

use LIN3S\CS\Error\Error;
use Symfony\Component\Process\Process;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class Phpmd implements Checker
{
    use FileFinder;

    public static function check(array $files = [], array $parameters = null)
    {
        $errors = [];
        foreach ($files as $file) {
            if (false === self::exist($file, $parameters['phpmd_path'], 'php')) {
                continue;
            }

            $process = new Process(
                'vendor/phpmd/phpmd/src/bin/phpmd ' . $file . ' text ' . implode(',', $parameters['phpmd_rules'])
            );
            $process->setWorkingDirectory($parameters['root_directory']);
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

<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CS\Checker;

use LIN3S\CS\Error\Error;
use Symfony\Component\Process\Process;

/**
 * Checker that automatizes all the logic about TwigLint.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class TwigLint extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files = [], array $parameters = null)
    {
        $errors = [];
        foreach ($files as $file) {
            if (false === self::exist($file, $parameters['twiglint_path'], 'twig')) {
                continue;
            }

            $process = new Process(sprintf('vendor/bin/twig-lint lint %s', $file), $parameters['root_directory']);
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

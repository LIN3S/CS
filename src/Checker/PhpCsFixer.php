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

use LIN3S\CS\Exception\CheckFailException;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Checker that automatizes all the logic about Fabien Potencier's PHP CS Fixer.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class PhpCsFixer extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files = [], array $parameters = null)
    {
        $processBuilder = new ProcessBuilder([
            'php',
            'vendor/fabpot/php-cs-fixer/php-cs-fixer',
            'fix',
            $parameters['phpcsfixer_path'],
            '--level=' . $parameters['phpcsfixer_level'],
            '--fixers=' . implode(',', $parameters['phpcsfixer_fixers'])
        ]);
        $processBuilder->setWorkingDirectory($parameters['root_directory']);
        $process = $processBuilder->getProcess();
        $process->run();

        if (!$process->isSuccessful()) {
            throw new CheckFailException('PHP CS Fixer', 'Something fails during php cs fixer\'s process');
        }
    }
}

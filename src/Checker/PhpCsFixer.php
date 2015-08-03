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

/**
 * Checker that automatizes all the logic about Fabien Potencier's PHP CS Fixer.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Jon Torrado <jontorrado@gmail.com>
 */
final class PhpCsFixer extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files = [], array $parameters = null)
    {
        // Exec PHP function is used because php-cs-fixer uses Symfony Process component inside
        // ProcessBuilder fails when is launched from another ProcessBuilder
        $commandLine = [
            'php',
            'vendor/fabpot/php-cs-fixer/php-cs-fixer',
            'fix',
            $parameters['phpcsfixer_path'],
            '--level=' . $parameters['phpcsfixer_level'],
            '--fixers=' . implode(',', $parameters['phpcsfixer_fixers'])
        ];
        exec(implode(' ', $commandLine));
    }
}

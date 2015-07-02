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

use LIN3S\CheckStyle\Exception\CheckFailException;
use Symfony\Component\Process\ProcessBuilder;

final class PhpFormatter extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files = [], $rootDirectory = null)
    {
        self::fixHeaders($rootDirectory);
        self::sortUseStatements($rootDirectory);
    }

    /**
     * Executes the Marc Morera's PHP-Formatter header fix command.
     *
     * @param string $rootDirectory The project root directory
     *
     * @return void
     * @throws \LIN3S\CheckStyle\Exception\CheckFailException
     */
    private function fixHeaders($rootDirectory)
    {
        $processBuilder = new ProcessBuilder([
            'php', 'vendor/mmoreram/php-formatter/bin/php-formatter', 'formatter:header:fix', '--config=src/', 'src/'
        ]);
        $processBuilder->setWorkingDirectory($rootDirectory);
        $process = $processBuilder->getProcess();
        $process->run();

        if (!$process->isSuccessful()) {
            throw new CheckFailException('PHP Formatter', 'Something fails durin php formatter\'s fix headers process');
        }
    }

    /**
     * Executes the Marc Morera's PHP-Formatter sort use statements command.
     *
     * @param string $rootDirectory The project root directory
     *
     * @return void
     * @throws \LIN3S\CheckStyle\Exception\CheckFailException
     */
    private function sortUseStatements($rootDirectory)
    {
        $processBuilder = new ProcessBuilder([
            'php', 'vendor/mmoreram/php-formatter/bin/php-formatter', 'formatter:use:sort', 'src/'
        ]);
        $processBuilder->setWorkingDirectory($rootDirectory);
        $process = $processBuilder->getProcess();
        $process->run();

        if (!$process->isSuccessful()) {
            throw new CheckFailException('PHP Formatter', 'Something fails during php formatter\'s sort uses process');
        }
    }
}

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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\ProcessBuilder;

final class PhpFormatter extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files = [], $rootDirectory = null)
    {
        self::symLinkFormatterYamlFile($rootDirectory);
        self::fixHeaders($rootDirectory);
        self::sortUseStatements($rootDirectory);
    }

    /**
     * Creates a symlink of .formatter.yml in the project root directory.
     *
     * @param string $rootDirectory The project root directory
     *
     * @return void
     * @throws \Exception when the symlink process fails
     */
    private static function symLinkFormatterYamlFile($rootDirectory)
    {
        $formatterYamlFile = $rootDirectory . '/.formatter.yml';
        $fileSystem = new Filesystem();

        try {
            if ($fileSystem->exists($formatterYamlFile)) {
                $fileSystem->remove($formatterYamlFile);
            }
            $fileSystem->symlink(__DIR__ . '/../.formatter.yml', $formatterYamlFile, true);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the symlink process: \n%s\n", $exception->getMessage());
        }
    }

    /**
     * Executes the Marc Morera's PHP-Formatter header fix command.
     *
     * @param string $rootDirectory The project root directory
     *
     * @return void
     * @throws \LIN3S\CheckStyle\Exception\CheckFailException
     */
    private static function fixHeaders($rootDirectory)
    {
        $processBuilder = new ProcessBuilder([
            'php', 'vendor/mmoreram/php-formatter/bin/php-formatter', 'formatter:header:fix', 'src/'
        ]);
        $processBuilder->setWorkingDirectory($rootDirectory);
        $process = $processBuilder->getProcess();
        $process->run();

        if (!$process->isSuccessful()) {
            echo $process->getErrorOutput();
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
    private static function sortUseStatements($rootDirectory)
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

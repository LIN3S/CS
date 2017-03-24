<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CS\Checker;

use LIN3S\CS\Exception\CheckFailException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Yaml\Yaml;

/**
 * Checker that automatizes all the logic about Marc Morera's PHP Formatter.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class PhpFormatter extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files = [], array $parameters = null)
    {
        foreach ($files as $file) {
            if (false === self::exist($file, $parameters['phpformatter_path'], 'php')) {
                continue;
            }

            self::updateFormatterYamlFile($parameters);
            self::fixHeaders($parameters);
            self::sortUseStatements($parameters);
        }
    }

    /**
     * Updates the project name of header block inside .formatter.yml.
     *
     * @param array $parameters The project parameters
     */
    private static function updateFormatterYamlFile($parameters)
    {
        $formatterYamlFile = Yaml::parse(file_get_contents(__DIR__ . '/../.formatter.yml.dist'));

        $formatterYamlFile['header'] = str_replace(
            'CHANGE-FOR-YOUR-AWESOME-NAME', $parameters['name'], $formatterYamlFile['header']
        );
        $formatterYamlFile['header'] = str_replace(
            'CHANGE-FOR-TYPE', $parameters['type'], $formatterYamlFile['header']
        );
        $formatterYamlFile['header'] = str_replace(
            'CHANGE-FOR-YEAR', $parameters['year'], $formatterYamlFile['header']
        );
        $formatterYamlFile['header'] = str_replace(
            'CHANGE-FOR-AUTHOR', $parameters['author'], $formatterYamlFile['header']
        );
        $formatterYamlFile['header'] = str_replace(
            'CHANGE-FOR-EMAIL', $parameters['email'], $formatterYamlFile['header']
        );
        file_put_contents(__DIR__ . '/../.formatter.yml', Yaml::dump($formatterYamlFile));
    }

    /**
     * Executes the Marc Morera's PHP-Formatter header fix command.
     *
     * @param array $parameters The project parameters
     *
     * @throws \LIN3S\CS\Exception\CheckFailException
     */
    private static function fixHeaders($parameters)
    {
        $process = new Process(
            sprintf(
                'php vendor/mmoreram/php-formatter/bin/php-formatter formatter:header:fix %s --config="%s"',
                $parameters['phpformatter_path'],
                __DIR__ . '/../'
            ),
            $parameters['root_directory']
        );
        $process->run();

        if (!$process->isSuccessful()) {
            echo $process->getErrorOutput();
            throw new CheckFailException('PHP Formatter', 'Something fails durin php formatter\'s fix headers process');
        }
    }

    /**
     * Executes the Marc Morera's PHP-Formatter sort use statements command.
     *
     * @param array $parameters The project parameters
     *
     * @throws \LIN3S\CS\Exception\CheckFailException
     */
    private static function sortUseStatements($parameters)
    {
        $processBuilder = new ProcessBuilder([
            'php',
            'vendor/mmoreram/php-formatter/bin/php-formatter',
            'formatter:use:sort',
            $parameters['phpformatter_path']
        ]);
        $processBuilder->setWorkingDirectory($parameters['root_directory']);
        $process = $processBuilder->getProcess();
        $process->run();

        if (!$process->isSuccessful()) {
            throw new CheckFailException('PHP Formatter', 'Something fails during php formatter\'s sort uses process');
        }
    }
}

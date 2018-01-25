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

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Jon Torrado <jontorrado@gmail.com>
 */
final class PhpCsFixer implements Checker
{
    use FileFinder;

    public static function check(array $files = [], array $parameters = null)
    {
        foreach ($files as $file) {
            if (false === self::exist($file, $parameters['phpcsfixer_path'], 'php')
                && false === self::exist($file, $parameters['phpcsfixer_test_path'], 'php')
            ) {
                continue;
            }

            if (false !== mb_strpos($file, 'Spec')) {
                self::execute($file, $parameters, '.phpspec_cs');
                continue;
            }

            self::execute($file, $parameters);
        }
    }

    public static function file(array $parameters)
    {
        self::phpCsConfigFile($parameters);
        self::phpspecCsConfigFile($parameters);
    }

    private static function execute($file, array $parameters, $checkFile = '.php_cs')
    {
        // Exec PHP function is used because php-cs-fixer uses Symfony Process component inside
        // Process fails when is launched from another Process
        $commandLine = [
            'php',
            'vendor/friendsofphp/php-cs-fixer/php-cs-fixer',
            'fix',
            $file,
            '--config=' . self::location($parameters) . '/' . $checkFile,
            '2> /dev/null',
        ];
        exec(implode(' ', $commandLine));
    }

    private static function phpCsConfigFile(array $parameters)
    {
        self::configFile('.php_cs', $parameters);
    }

    private static function phpspecCsConfigFile(array $parameters)
    {
        self::configFile('.phpspec_cs', $parameters);
    }

    private static function configFile($fileName, array $parameters)
    {
        $file = file_get_contents(__DIR__ . '/../' . $fileName . '.dist');

        $file = str_replace(
            '$$CHANGE-FOR-YOUR-AWESOME-NAME CHANGE-FOR-TYPE$$',
            $parameters['name'],
            $file
        );
        $file = str_replace(
            '$$CHANGE-FOR-YEAR$$',
            $parameters['year'],
            $file
        );
        $file = str_replace(
            '$$CHANGE-FOR-TYPE$$',
            $parameters['type'],
            $file
        );
        $file = str_replace(
            '$$CHANGE-FOR-PHPCSFIXER-PATH$$',
            '/' . $parameters['phpcsfixer_path'],
            $file
        );
        $file = str_replace(
            '$$CHANGE-FOR-PHPCSFIXER-TEST-PATH$$',
            '/' . $parameters['phpcsfixer_test_path'],
            $file
        );

        try {
            file_put_contents(self::location($parameters) . '/' . $fileName, $file);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the creating process: \n%s\n", $exception->getMessage());
        }
    }

    private static function location(array $parameters)
    {
        return $parameters['root_directory'] . '/' . $parameters['phpcsfixer_file_location'];
    }
}

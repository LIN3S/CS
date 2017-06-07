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
            if (false === self::exist($file, $parameters['phpcsfixer_path'], 'php')) {
                continue;
            }

            // Exec PHP function is used because php-cs-fixer uses Symfony Process component inside
            // ProcessBuilder fails when is launched from another ProcessBuilder
            $commandLine = [
                'php',
                'vendor/friendsofphp/php-cs-fixer/php-cs-fixer',
                'fix',
                $file,
                '--config=.php_cs',
            ];
            exec(implode(' ', $commandLine));
        }
    }

    public static function file(array $parameters)
    {
        self::phpCsConfigFile($parameters);
        self::phpspecCsConfigFile($parameters);
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

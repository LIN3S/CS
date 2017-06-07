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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class EsLint implements Checker
{
    use FileFinder;
    use ToolAvailability;

    public static function check(array $files = [], array $parameters = null)
    {
        self::isAvailable('eslint');
        self::file($parameters);

        $excludes = [];
        if (true === array_key_exists('eslint_exclude', $parameters)) {
            foreach ($parameters['eslint_exclude'] as $key => $exclude) {
                $excludes[$key] = $parameters['eslint_path'] . '/' . $exclude;
            }
        }

        $errors = [];
        foreach ($files as $file) {
            if (false === self::exist($file, $parameters['eslint_path'], 'js') || in_array($file, $excludes, true)) {
                continue;
            }

            $process = new Process(
                sprintf('eslint %s -c %s/.eslint.yml', $file, self::location($parameters)),
                $parameters['root_directory']
            );
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

    public static function file($parameters)
    {
        $yaml = array_replace_recursive(
            Yaml::parse(file_get_contents(__DIR__ . '/../.eslint.yml.dist')), $parameters['eslint_rules']
        );
        $location = self::location($parameters) . '/.eslint.yml';
        $fileSystem = new Filesystem();

        try {
            $fileSystem->remove($location);
            $fileSystem->touch($location);
            file_put_contents($location, Yaml::dump($yaml));
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the creating process: \n%s\n", $exception->getMessage());
        }
    }

    private static function location($parameters)
    {
        return $parameters['root_directory'] . '/' . $parameters['eslint_file_location'];
    }
}

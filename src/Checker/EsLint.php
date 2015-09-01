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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;

/**
 * Checker that automatizes all the logic about ESLint.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class EsLint extends Checker
{
    /**
     * {@inheritdoc}
     */
    public static function check(array $files = [], array $parameters = null)
    {
        $esLintYamlFile = array_replace_recursive(
            Yaml::parse(file_get_contents(__DIR__ . '/../.eslint.yml.dist')), $parameters['eslint_rules']
        );
        $esLintFileLocation = $parameters['root_directory'] . $parameters['eslint_file_location'];
        static::createEsLintFile($esLintFileLocation, Yaml::dump($esLintYamlFile));

        $excludes = [];
        if (true === array_key_exists('eslint_exclude', $parameters)) {
            foreach ($parameters['eslint_exclude'] as $key => $exclude) {
                $excludes[$key] = $parameters['eslint_path'] . '/' . $exclude;
            }
        }

        $errors = [];
        foreach ($files as $file) {
            if (false === self::exist($file, $parameters['eslint_path'], 'js') || in_array($file, $excludes)) {
                continue;
            }

            $process = new Process(
                sprintf('eslint %s -c %s/.eslint.yml', $file, $esLintFileLocation), $parameters['root_directory']
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

    /**
     * Static method that allows to create a .eslint.yml file.
     *
     * @param string $location The location path of .eslint.yml
     * @param string $content  The content of file
     */
    private static function createEsLintFile($location, $content)
    {
        $fileSystem = new Filesystem();
        $location .= '/.eslint.yml';

        try {
            $fileSystem->remove($location);
            $fileSystem->touch($location);
            file_put_contents($location, $content);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the creating process: \n%s\n", $exception->getMessage());
        }
    }
}

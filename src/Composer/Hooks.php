<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CS\Composer;

use LIN3S\CS\Application;
use LIN3S\CS\Checker\EsLint;
use LIN3S\CS\Checker\ScssLint;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Composer scripts that connect your application
 * with LIN3S CS in an easy way.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class Hooks
{
    /**
     * Static method that allows to create a hooks symlink
     * when Composer throws the install or update commands.
     */
    public static function addHooks()
    {
        $hooksDirectory = __DIR__ . '/../../../../../.git/hooks';
        $fileSystem = new Filesystem();

        try {
            if ($fileSystem->exists($hooksDirectory)) {
                $fileSystem->remove($hooksDirectory);
            }
            $fileSystem->symlink(__DIR__ . '/../Hooks', $hooksDirectory, true);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the symlink process: \n%s\n", $exception->getMessage());
        }
    }

    /**
     * Static method that creates .lin3s_cs.yml.dist if it does not exist.
     */
    public static function buildDistFile()
    {
        $distFile = __DIR__ . '/../../../../../.lin3s_cs.yml.dist';
        $fileSystem = new Filesystem();

        try {
            if ($fileSystem->exists($distFile)) {
                return;
            }
            $fileSystem->copy(__DIR__ . '/../../.lin3s_cs.yml.dist', $distFile);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the touch process: \n%s\n", $exception->getMessage());
        }
    }

    /**
     * Static method that allows to create a .editorconfig symlink,
     * .scss_lint.yml and .eslint.yml files when Composer throws the
     * install or update commands.
     */
    public static function addFiles()
    {
        $app = new Application();
        ScssLint::scssLintFile($app->parameters());
        EsLint::esLintFile($app->parameters());

        $editorConfig = __DIR__ . '/../../../../../.editorconfig';
        $fileSystem = new Filesystem();

        try {
            $fileSystem->remove($editorConfig);
            $fileSystem->symlink(__DIR__ . '/../../.editorconfig', $editorConfig, true);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the symlink process: \n%s\n", $exception->getMessage());
        }
    }
}

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

namespace LIN3S\CS\Composer;

use LIN3S\CS\Application;
use LIN3S\CS\Checker\EsLint;
use LIN3S\CS\Checker\PhpCsFixer;
use LIN3S\CS\Checker\ScssLint;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class Hooks
{
    public static function addHooks()
    {
        $hooksDirectory = self::rootDir() . '/.git/hooks';
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

    public static function buildDistFile()
    {
        $distFile = self::rootDir() . '/.lin3s_cs.yml.dist';
        $fileSystem = new Filesystem();

        try {
            if ($fileSystem->exists($distFile)) {
                return;
            }
            $fileSystem->copy(self::lin3sCsRootDir() . '/.lin3s_cs.yml.dist', $distFile);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the touch process: \n%s\n", $exception->getMessage());
        }
    }

    public static function addFiles()
    {
        $app = new Application();
        ScssLint::file($app->parameters());
        EsLint::file($app->parameters());
        PhpCsFixer::file($app->parameters());

        $editorConfig = self::rootDir() . '/.editorconfig';
        $fileSystem = new Filesystem();

        try {
            $fileSystem->remove($editorConfig);
            $fileSystem->symlink(self::lin3sCsRootDir() . '/.editorconfig', $editorConfig, true);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the symlink process: \n%s\n", $exception->getMessage());
        }
    }

    private static function rootDir()
    {
        return __DIR__ . '/../../../../../../..';
    }

    private static function lin3sCsRootDir()
    {
        return __DIR__ . '/../..';
    }
}

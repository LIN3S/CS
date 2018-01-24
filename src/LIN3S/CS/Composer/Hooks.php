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
use LIN3S\CS\Checker\Stylelint;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class Hooks
{
    public static function addHooks() : void
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

    public static function buildDistFile() : void
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

    public static function addFiles() : void
    {
        $app = new Application();
        $enabled = $app->parameters()['enabled'] ?? [];

        !in_array('stylelint', $enabled, true) ?: Stylelint::file($app->parameters());
        !in_array('eslint', $enabled, true) ?: EsLint::file($app->parameters());
        !in_array('phpcsfixer', $enabled, true) ?: PhpCsFixer::file($app->parameters());

        $editorConfig = self::rootDir() . '/.editorconfig';
        $fileSystem = new Filesystem();

        try {
            $fileSystem->remove($editorConfig);
            $fileSystem->symlink(self::lin3sCsRootDir() . '/.editorconfig', $editorConfig, true);
        } catch (\Exception $exception) {
            echo sprintf("Something wrong happens during the symlink process: \n%s\n", $exception->getMessage());
        }
    }

    private static function rootDir() : string
    {
        return __DIR__ . '/../../../../../../..';
    }

    private static function lin3sCsRootDir() : string
    {
        return __DIR__ . '/../..';
    }
}

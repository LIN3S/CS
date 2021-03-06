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

use LIN3S\CS\Exception\CheckFailException;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class Composer implements Checker
{
    public static function check(array $files = [], array $parameters = null)
    {
        $composerJsonDetected = false;
        $composerLockDetected = false;

        foreach ($files as $file) {
            if ('composer.json' === $file) {
                $composerJsonDetected = true;
            }

            if ('composer.lock' === $file) {
                $composerLockDetected = true;
            }
        }

        if ($composerJsonDetected && !$composerLockDetected) {
            throw new CheckFailException('Composer', 'composer.lock must be committed if composer.json is modified!');
        }
    }
}

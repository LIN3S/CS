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
 */
trait FileFinder
{
    protected static function exist($file, $path, $fileType = 'php')
    {
        return 0 !== preg_match('/^' . str_replace('/', '\/', $path) . '\/(.*)(\.' . $fileType . ')$/', $file);
    }
}

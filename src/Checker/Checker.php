<?php

/*
 * This file is part of the Check Style package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CheckStyle\Checker;

use LIN3S\CheckStyle\Checker\Interfaces\CheckerInterface;

abstract class Checker implements CheckerInterface
{
    /**
     * Method that simplifies the use of regex to find
     * an extension given file inside path given.
     *
     * @param mixed   $file     The file
     * @param  string $path     The path
     * @param string  $fileType The file type, by default is 'php'
     *
     * @return bool
     */
    protected static function exist($file, $path, $fileType = 'php')
    {
        return 0 !== preg_match('/^' . str_replace('/', '\/', $path) . '\/(.*)(\.' . $fileType . ')$/', $file);
    }

    /**
     * This class cannot be instantiated.
     */
    private function __construct()
    {
    }

    /**
     * This class cannot be cloned.
     */
    private function __clone()
    {
    }
}

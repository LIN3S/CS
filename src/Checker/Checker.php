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

use LIN3S\CS\Checker\Interfaces\CheckerInterface;

/**
 * Base abstract checker class. It is useful to provides some common
 * helper methods and all checkers must only instantiate statically.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
abstract class Checker implements CheckerInterface
{
    /**
     * Method that simplifies the use of regex to find
     * an extension given file inside path given.
     *
     * @param mixed  $file     The file
     * @param string $path     The path
     * @param string $fileType The file type, by default is 'php'
     *
     * @return bool
     */
    protected static function exist($file, $path, $fileType = 'php')
    {
        return 0 !== preg_match('/^' . str_replace('/', '\/', $path) . '\/(.*)(\.' . $fileType . ')$/', $file);
    }

    /**
     * Checks if the tool is installed in the machine,
     * otherwise throws an exception.
     *
     * @param string $tool The name of the tool
     *
     * @throws \LIN3S\CS\Exception\ToolUnavailableException when the tool is unavailable
     */
    protected static function isAvailable($tool)
    {
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

<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CS\Error;

/**
 * Error class that encapsulates all checkers'
 * errors in manage friendly domain object.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class Error
{
    /**
     * The file name.
     *
     * @var string
     */
    protected $file;

    /**
     * The error string.
     *
     * @var string
     */
    protected $error;

    /**
     * The output.
     *
     * @var string
     */
    protected $output;

    /**
     * Constructor.
     *
     * @param string $file   The file name
     * @param string $error  The error string
     * @param string $output The output
     */
    public function __construct($file, $error, $output)
    {
        $this->file = $file;
        $this->error = $error;
        $this->output = $output;
    }

    /**
     * Gets the file name.
     *
     * @return string
     */
    public function file()
    {
        return $this->file;
    }

    /**
     * Gets the error string.
     *
     * @return string
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * Gets the output.
     *
     * @return string
     */
    public function output()
    {
        return $this->output;
    }
}

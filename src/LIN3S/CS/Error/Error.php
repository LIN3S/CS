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

namespace LIN3S\CS\Error;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class Error
{
    private $file;
    private $error;
    private $output;

    public function __construct($file, $error, $output)
    {
        $this->file = $file;
        $this->error = $error;
        $this->output = $output;
    }

    public function file()
    {
        return $this->file;
    }

    public function error()
    {
        return $this->error;
    }

    public function output()
    {
        return $this->output;
    }
}

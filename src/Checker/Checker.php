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
     * This class cannot be instantiated.
     */
    private function __construct()
    {
    }
}

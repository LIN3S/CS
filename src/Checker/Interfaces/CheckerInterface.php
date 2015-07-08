<?php

/*
 * This file is part of the Check Style package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CheckStyle\Checker\Interfaces;

interface CheckerInterface
{
    /**
     * Checks the given files.
     *
     * @param array      $files      The files that going to be a check
     * @param array|null $parameters The project parameters that declared inside the .checkStyle.yml
     *
     * @return mixed
     */
    public static function check(array $files = [], array $parameters = null);
}
<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CS\Checker\Interfaces;

/**
 * Interface for different checkers in the application. This interface
 * forces all checkers to implement "check" method in the following way.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface CheckerInterface
{
    /**
     * Checks the given files.
     *
     * @param array      $files      The files that going to be a check
     * @param array|null $parameters The project parameters that declared inside the .lin3s_cs.yml
     *
     * @return mixed
     */
    public static function check(array $files = [], array $parameters = null);
}

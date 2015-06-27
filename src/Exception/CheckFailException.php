<?php

/*
 * This file is part of the Check Style package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CheckStyle\Exception;

class CheckFailException extends \Exception
{
    /**
     * Constructor.
     *
     * @param string $checkName The executed check name
     * @param string $message   The extra message
     */
    public function __construct($checkName, $message = '')
    {
        parent::__construct(sprintf('Check fails during the %s. %s', $checkName, $message));
    }
}

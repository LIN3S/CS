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

namespace LIN3S\CS\Exception;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class CheckFailException extends \Exception
{
    public function __construct($checkName, $message = '')
    {
        parent::__construct(sprintf('Check fails during the %s. %s', $checkName, $message));
    }
}

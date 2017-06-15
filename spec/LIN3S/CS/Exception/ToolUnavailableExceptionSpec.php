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

namespace spec\LIN3S\CS\Exception;

use LIN3S\CS\Exception\ToolUnavailableException;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of ToolUnavailable exception class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ToolUnavailableExceptionSpec extends ObjectBehavior
{
    function it_can_be_thrown()
    {
        $this->beConstructedWith('Dummy-Tool-Name');

        $this->shouldHaveType(ToolUnavailableException::class);
        $this->shouldHaveType(\Exception::class);

        $this->getMessage()->shouldReturn('Dummy-Tool-Name is unavailable so, you have to consider to install it');
    }
}

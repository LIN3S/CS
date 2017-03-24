<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\LIN3S\CS\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Spec file of CheckFail exception class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class CheckFailExceptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Dummy-Check-Name', 'Dummy message');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\CS\Exception\CheckFailException');
    }

    function it_should_be_extends_exception()
    {
        $this->shouldHaveType('Exception');
    }
}

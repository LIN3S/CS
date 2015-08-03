<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\LIN3S\CS\Error;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Spec file of Error class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ErrorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('/path/to/file/1.txt', 'The error message', 'This is the output');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\CS\Error\Error');
    }

    function it_should_get_the_file()
    {
        $this->file()->shouldReturn('/path/to/file/1.txt');
    }

    function it_should_get_the_error()
    {
        $this->error()->shouldReturn('The error message');
    }

    function it_should_get_the_output()
    {
        $this->output()->shouldReturn('This is the output');
    }
}

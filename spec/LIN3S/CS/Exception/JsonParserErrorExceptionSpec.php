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

use LIN3S\CS\Exception\JsonParserErrorException;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class JsonParserErrorExceptionSpec extends ObjectBehavior
{
    function it_can_be_thrown()
    {
        $this->shouldHaveType(JsonParserErrorException::class);
        $this->shouldHaveType(\Exception::class);

        $this->getMessage()->shouldReturn(
            'The format of the JSON file is invalid. Please validate ' .
            'the syntax with for example "https://jsonlint.com/"'
        );
    }
}

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

namespace spec\LIN3S\CS\Git;

use PhpSpec\ObjectBehavior;

/**
 * Spec file of Git class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class GitSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LIN3S\CS\Git\Git');
    }

    function it_should_be_add_files()
    {
        $files = [__DIR__ . '/../fixtures/Git/1.txt', 'path/to/file/2.txt'];

        $this::addFiles($files)->shouldReturn($files);
    }
}

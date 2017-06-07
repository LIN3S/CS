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

namespace LIN3S\CS\Checker;

use LIN3S\CS\Exception\ToolUnavailableException;
use Symfony\Component\Process\Process;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
trait ToolAvailability
{
    public function isAvailable($tool)
    {
        $process = new Process(sprintf('%s -v', $tool));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ToolUnavailableException($tool);
        }
    }
}

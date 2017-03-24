<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CS\Exception;

/**
 * Tool unavailable exception custom exception.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ToolUnavailableException extends \Exception
{
    /**
     * Constructor.
     *
     * @param string $toolName The tool name
     */
    public function __construct($toolName)
    {
        parent::__construct(sprintf('%s is unavailable so, you have to consider to install it', $toolName));
    }
}

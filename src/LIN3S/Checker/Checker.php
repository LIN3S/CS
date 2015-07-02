<?php

namespace LIN3S\CheckStyle\Checker;

use LIN3S\CheckStyle\Checker\Interfaces\CheckerInterface;

abstract class Checker implements CheckerInterface
{
    /**
     * This class cannot be instantiated.
     */
    private function __construct()
    {
    }
}

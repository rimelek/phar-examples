<?php

namespace Rimelek\PharExample\Example06;


use Rimelek\PharExample\Example06\Exception\PHPInfoException;

class PHPInfo
{
    private int $what;

    /**
     * @param int $what
     */
    public function __construct(int $what = INFO_ALL)
    {
        $this->what = $what;
    }

    /**
     * @throws PHPInfoException
     */
    public function run(): void
    {
        if (!phpinfo($this->what)) {
            throw new PHPInfoException('function phpinfo() has failed');
        }
    }
}
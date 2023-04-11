<?php

namespace Rimelek\PharExample\Example05;


use Rimelek\PharExample\Example05\Exception\PHPInfoException;

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
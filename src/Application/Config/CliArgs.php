<?php

declare(strict_types=1);

namespace SocialFood\Application\Config;

use CliArgs\CliArgs as PhpCliArgs;

class CliArgs extends PhpCliArgs
{
    public function setCliArgsConfig(array $cliArgsConfig)
    {
        $this->setConfig($cliArgsConfig);
    }
}

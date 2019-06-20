<?php

use SocialFood\Application\Repository\Factory\PDOFactory;
use SocialFood\Application\Wrapper\Factory\MysqlWrapperFactory;
use SocialFood\Application\Wrapper\MysqlWrapper;

// non lazy loaded Classes
return [
    PDO::class          => PDOFactory::class,
    MysqlWrapper::class => MysqlWrapperFactory::class,
];

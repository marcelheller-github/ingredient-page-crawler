<?php

use SocialFood\Application\Bus\CommandBusProxy;
use SocialFood\Application\Bus\Factory\CommandBusProxyFactory;

// lazy loaded
return [
    // LazyLoaded::class => LazyLoadedFactory::class
    CommandBusProxy::class => CommandBusProxyFactory::class,
];

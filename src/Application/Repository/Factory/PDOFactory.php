<?php

declare(strict_types=1);

namespace SocialFood\Application\Repository\Factory;

use Exception;
use Psr\Container\ContainerInterface;
use PDO;
use PDOException;
use SocialFood\Application\Loader\FactoryInterface;

class PDOFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): PDO
    {
        $settings   = $container->get('settings');
        $dbSettings = $settings['db'];

        try {
            $pdo = new PDO(
                'mysql:host=' . $dbSettings['host'] . ';dbname=' .  $dbSettings['dbname'],
                $dbSettings['user'],
                $dbSettings['password']
            );
        } catch (PDOException $e) {
            throw new Exception('PDO error: ' . $e->getMessage());
        }

        return $pdo;
    }
}

// user     = debian-sys-maint
// password = 5eVw62bEz4PbNn0e


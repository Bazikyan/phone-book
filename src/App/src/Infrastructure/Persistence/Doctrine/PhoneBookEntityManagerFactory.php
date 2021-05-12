<?php


namespace App\Infrastructure\Persistence\Doctrine;


use App\Infrastructure\Persistence\Doctrine\Types\PhoneIdentityType;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

class PhoneBookEntityManagerFactory
{

    public function __invoke(ContainerInterface $container): EntityManager
    {
        $paths = [
            __DIR__ . "/Mappings",
        ];
        $isDevMode = true;

        // the connection configuration
        $dbParams = array(
            'driver'   => $_ENV['MYSQL_DRIVER'],
            'user'     => $_ENV['MYSQL_USER'],
            'password' => $_ENV['MYSQL_PASSWORD'],
            'host'     => $_ENV['MYSQL_HOST'],
            'dbname'   => $_ENV['MYSQL_DBNAME'],
        );

        $config = Setup::createXMLMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);

        if (!Type::hasType(PhoneIdentityType::TYPE_NAME)) {
            Type::addType(PhoneIdentityType::TYPE_NAME, PhoneIdentityType::class);
        }

        return $entityManager;
    }
}
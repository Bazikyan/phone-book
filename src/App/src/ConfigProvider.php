<?php

declare(strict_types=1);

namespace App;

use App\Application\CreatePhone\CreatePhoneService;
use App\Application\DeletePhone\DeletePhoneService;
use App\Application\FindPhone\All\FindAllPhonesService;
use App\Application\FindPhone\All\FindAllPhonesServiceFactory;
use App\Application\FindPhone\ById\FindPhoneByIdService;
use App\Application\FindPhone\ById\FindPhoneByIdServiceFactory;
use App\Application\FindPhone\ByName\FindPhonesByNameService;
use App\Application\FindPhone\ByName\FindPhonesByNameServiceFactory;
use App\Application\UpdatePhone\UpdatePhoneService;
use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;
use App\Domain\Service\CountryCodeValidatorInterface;
use App\Domain\Service\TimezoneNameValidatorInterface;
use App\Infrastructure\Application\CreatePhone\FlushedCreatePhoneService;
use App\Infrastructure\Application\CreatePhone\FlushedCreatePhoneServiceFactory;
use App\Infrastructure\Application\DeletePhone\FlushedDeletePhoneService;
use App\Infrastructure\Application\DeletePhone\FlushedDeletePhoneServiceFactory;
use App\Infrastructure\Application\UpdatePhone\FlushedUpdatePhoneService;
use App\Infrastructure\Application\UpdatePhone\FlushedUpdatePhoneServiceFactory;
use App\Infrastructure\Domain\Model\DoctrinePhoneIdentityFactory;
use App\Infrastructure\Domain\Model\DoctrinePhoneRepository;
use App\Infrastructure\Domain\Model\DoctrinePhoneRepositoryFactory;
use App\Infrastructure\Domain\Service\Validator\CountryCodeValidator;
use App\Infrastructure\Domain\Service\Validator\CountryCodeValidatorFactory;
use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\CountryCodesRetriever;
use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\CountryCodesRetrieverFactory;
use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\TimezoneNamesRetriever;
use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\TimezoneNamesRetrieverFactory;
use App\Infrastructure\Domain\Service\Validator\TimezoneNameValidator;
use App\Infrastructure\Domain\Service\Validator\TimezoneNameValidatorFactory;
use App\Infrastructure\Http;
use App\Infrastructure\Persistence\Doctrine\PhoneBookEntityManager;
use App\Infrastructure\Persistence\Doctrine\PhoneBookEntityManagerFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,

                DoctrinePhoneIdentityFactory::class => DoctrinePhoneIdentityFactory::class,

                Http\Phones\Id\Get\Responder::class => Http\Phones\Id\Get\Responder::class,
                Http\Phones\Id\Patch\Responder::class => Http\Phones\Id\Patch\Responder::class,
                Http\Phones\Id\Delete\Responder::class => Http\Phones\Id\Delete\Responder::class,
                Http\Phones\Get\Responder::class => Http\Phones\Get\Responder::class,
                Http\Phones\Post\Responder::class => Http\Phones\Post\Responder::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,

                PhoneBookEntityManager::class => PhoneBookEntityManagerFactory::class,

                // Domain
                DoctrinePhoneRepository::class => DoctrinePhoneRepositoryFactory::class,
                CountryCodeValidator::class => CountryCodeValidatorFactory::class,
                CountryCodesRetriever::class => CountryCodesRetrieverFactory::class,
                TimezoneNameValidator::class => TimezoneNameValidatorFactory::class,
                TimezoneNamesRetriever::class => TimezoneNamesRetrieverFactory::class,

                // Application
                FlushedCreatePhoneService::class => FlushedCreatePhoneServiceFactory::class,
                FlushedDeletePhoneService::class => FlushedDeletePhoneServiceFactory::class,
                FlushedUpdatePhoneService::class => FlushedUpdatePhoneServiceFactory::class,
                FindPhoneByIdService::class => FindPhoneByIdServiceFactory::class,
                FindAllPhonesService::class => FindAllPhonesServiceFactory::class,
                FindPhonesByNameService::class => FindPhonesByNameServiceFactory::class,

                // Actions
                Http\Phones\Id\Get\Action::class => Http\Phones\Id\Get\ActionFactory::class,
                Http\Phones\Id\Patch\Action::class => Http\Phones\Id\Patch\ActionFactory::class,
                Http\Phones\Id\Delete\Action::class => Http\Phones\Id\Delete\ActionFactory::class,
                Http\Phones\Get\Action::class => Http\Phones\Get\ActionFactory::class,
                Http\Phones\Post\Action::class => Http\Phones\Post\ActionFactory::class,
            ],
            'aliases' => [
                PhoneRepository::class => DoctrinePhoneRepository::class,
                PhoneIdentityFactory::class => DoctrinePhoneIdentityFactory::class,
                CountryCodeValidatorInterface::class => CountryCodeValidator::class,
                TimezoneNameValidatorInterface::class => TimezoneNameValidator::class,

                CreatePhoneService::class => FlushedCreatePhoneService::class,
                DeletePhoneService::class => FlushedDeletePhoneService::class,
                UpdatePhoneService::class => FlushedUpdatePhoneService::class,
            ],
        ];
    }
}

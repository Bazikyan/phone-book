<?php


namespace App\Infrastructure\Domain\Service\Validator;


use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\TimezoneNamesRetriever;
use Psr\Container\ContainerInterface;

class TimezoneNameValidatorFactory
{

    public function __invoke(ContainerInterface $container): TimezoneNameValidator
    {
        return new TimezoneNameValidator(
            $container->get(TimezoneNamesRetriever::class)
        );
    }
}
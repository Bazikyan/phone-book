<?php


namespace App\Infrastructure\Domain\Service\Validator;


use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\CountryCodesRetriever;
use Psr\Container\ContainerInterface;

class CountryCodeValidatorFactory
{

    public function __invoke(ContainerInterface $container): CountryCodeValidator
    {
        return new CountryCodeValidator(
            $container->get(CountryCodesRetriever::class)
        );
    }
}
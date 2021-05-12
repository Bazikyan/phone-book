<?php


namespace App\Infrastructure\Domain\Service\Validator\GuzzleRetriever;


use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

class CountryCodesRetrieverFactory
{

    public function __invoke(ContainerInterface $container): CountryCodesRetriever
    {
        return new CountryCodesRetriever(
            new Client()
        );
    }
}
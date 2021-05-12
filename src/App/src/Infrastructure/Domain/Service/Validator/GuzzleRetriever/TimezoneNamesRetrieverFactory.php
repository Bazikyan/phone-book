<?php


namespace App\Infrastructure\Domain\Service\Validator\GuzzleRetriever;


use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

class TimezoneNamesRetrieverFactory
{

    public function __invoke(ContainerInterface $container): TimezoneNamesRetriever
    {
        return new TimezoneNamesRetriever(
            new Client()
        );
    }
}
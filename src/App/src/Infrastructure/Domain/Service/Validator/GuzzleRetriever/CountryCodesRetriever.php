<?php


namespace App\Infrastructure\Domain\Service\Validator\GuzzleRetriever;


use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

class CountryCodesRetriever extends AbstractRetriever
{
    private const URL_COUNTRY_CODES = 'http://country.io/continent.json';

    protected function buildRequest(): RequestInterface
    {
        return new Request('GET', self::URL_COUNTRY_CODES);
    }

    protected function parseContent(array $contentsArray): array
    {
        return array_keys($contentsArray);
    }
}
<?php


namespace App\Infrastructure\Domain\Service\Validator\GuzzleRetriever;


use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

class TimezoneNamesRetriever extends AbstractRetriever
{
    private const URL_TIMEZONE_NAMES = 'http://worldtimeapi.org/api/timezone';

    protected function buildRequest(): RequestInterface
    {
        return new Request('GET', self::URL_TIMEZONE_NAMES);
    }

    protected function parseContent(array $contentsArray): array
    {
        return $contentsArray;
    }
}
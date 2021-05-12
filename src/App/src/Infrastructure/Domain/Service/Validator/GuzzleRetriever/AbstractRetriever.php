<?php


namespace App\Infrastructure\Domain\Service\Validator\GuzzleRetriever;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

abstract class AbstractRetriever
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return array|string[]
     *
     * @throws RuntimeException
     */
    public function retrieve(): array
    {
        $request = $this->buildRequest();

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Something went wrong');
        }


        return $this->handleResponse($response);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array|string[]
     *
     * @throws RuntimeException
     */
    protected function handleResponse(ResponseInterface $response): array
    {
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Something went wrong');
        }

        $contentsJson = $response->getBody()->getContents();

        $contentsArray = json_decode($contentsJson, true);
        if (!is_array($contentsArray)) {
            throw new RuntimeException('Something went wrong');
        }

        return $this->parseContent($contentsArray);
    }


    abstract protected function buildRequest(): RequestInterface;

    abstract protected function parseContent(array $contentsArray): array;


    protected function getClient(): Client
    {
        return $this->client;
    }
}
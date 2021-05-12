<?php


namespace App\Infrastructure\Http\Phones\Id\Get;


use App\Application\FindPhone\Dto\PhoneDto;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;

class Responder
{
    public function respondOk(PhoneDto $phone): ResponseInterface
    {
        return new JsonResponse(
            [
                'data' => $phone->toArray(),
            ],
            200
        );
    }

    public function errorRespond(string $message): ResponseInterface
    {
        return new JsonResponse(
            [
                'errors' => [
                    0 => [
                        'status' => 404,
                        'title' => $message,
                    ],
                ],
            ]
        );
    }
}
<?php


namespace App\Infrastructure\Http\Phones\Get;


use App\Application\FindPhone\Dto\PhoneDtoList;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;

class Responder
{

    public function respond(PhoneDtoList $phoneList): ResponseInterface
    {
        return new JsonResponse(
            [
                'data' => $phoneList->toArray(),
            ],
            200
        );
    }
}
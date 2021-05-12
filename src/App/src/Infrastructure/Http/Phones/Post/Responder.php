<?php


namespace App\Infrastructure\Http\Phones\Post;


use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;

class Responder
{

    public function respondOk(string $id): ResponseInterface
    {
        return new JsonResponse(
            [
                'data' =>[
                    'type' => 'phones',
                    'id' => $id,
                ],
            ],
            201
        );
    }

    public function serverErrorResponse(): ResponseInterface
    {
        return new JsonResponse(
            [
                'errors' => [
                    0 => [
                        'status' => 500,
                        'title' => 'Something went wrong',
                    ],
                ],
            ],
            500
        );
    }

    public function clientErrorResponse(string $massage): ResponseInterface
    {
        return new JsonResponse(
            [
                'errors' => [
                    0 => [
                        'status' => 400,
                        'title' => $massage,
                    ]
                ]
            ]
        );
    }
}
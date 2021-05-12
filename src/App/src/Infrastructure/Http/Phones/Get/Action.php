<?php


namespace App\Infrastructure\Http\Phones\Get;


use App\Application\FindPhone\All\FindAllPhonesService;
use App\Application\FindPhone\ByName\FindPhonesByNameRequest;
use App\Application\FindPhone\ByName\FindPhonesByNameService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Action implements RequestHandlerInterface
{

    private FindAllPhonesService $findAllPhonesService;

    private FindPhonesByNameService $findPhoneByNameService;

    private Responder $responder;

    public function __construct(
        FindAllPhonesService $findAllPhonesService,
        FindPhonesByNameService $findPhoneByNameService,
        Responder $responder
    ) {
        $this->findAllPhonesService = $findAllPhonesService;
        $this->findPhoneByNameService = $findPhoneByNameService;
        $this->responder = $responder;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $name = $request->getQueryParams()['name'] ?? null;
        if (empty($name)) {
            $phoneList = $this->getFindAllPhonesService()->execute();
        } else {
            $phoneList = $this->getFindPhoneByNameService()->execute(new FindPhonesByNameRequest($name));
        }

        return $this->getResponder()->respond($phoneList);
    }

    private function getFindAllPhonesService(): FindAllPhonesService
    {
        return $this->findAllPhonesService;
    }

    private function getFindPhoneByNameService(): FindPhonesByNameService
    {
        return $this->findPhoneByNameService;
    }

    private function getResponder(): Responder
    {
        return $this->responder;
    }
}

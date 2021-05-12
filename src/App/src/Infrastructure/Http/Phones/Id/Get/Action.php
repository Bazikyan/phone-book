<?php


namespace App\Infrastructure\Http\Phones\Id\Get;


use App\Application\FindPhone\ById\Exception\PhoneNotFoundException;
use App\Application\FindPhone\ById\FindPhoneByIdRequest;
use App\Application\FindPhone\ById\FindPhoneByIdService;
use App\Domain\Model\Exception\InvalidIdentityException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Action implements RequestHandlerInterface
{

    private FindPhoneByIdService $findPhoneByIdService;

    private Responder $responder;

    public function __construct(FindPhoneByIdService $findPhoneByIdService, Responder $responder)
    {
        $this->findPhoneByIdService = $findPhoneByIdService;
        $this->responder = $responder;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        try {
            $phone = $this->getFindPhoneByIdService()->execute(new FindPhoneByIdRequest($id));
        } catch (InvalidIdentityException | PhoneNotFoundException $e) {

            return $this->getResponder()->errorRespond($e->getMessage());
        }

        return $this->getResponder()->respondOk($phone);
    }

    private function getFindPhoneByIdService(): FindPhoneByIdService
    {
        return $this->findPhoneByIdService;
    }

    private function getResponder(): Responder
    {
        return $this->responder;
    }
}
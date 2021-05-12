<?php


namespace App\Infrastructure\Http\Phones\Id\Delete;


use App\Application\DeletePhone\DeletePhoneRequest;
use App\Application\DeletePhone\DeletePhoneService;
use App\Domain\Model\Exception\PhoneExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Action implements RequestHandlerInterface
{
    private DeletePhoneService $deletePhoneService;

    private Responder $responder;

    public function __construct(DeletePhoneService $deletePhoneService, Responder $responder)
    {
        $this->deletePhoneService = $deletePhoneService;
        $this->responder = $responder;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        try {
            $this->getDeletePhoneService()->execute(new DeletePhoneRequest($id));
        } catch (PhoneExceptionInterface $e) {
            $this->getResponder()->clientErrorResponse($e->getMessage());
        } catch (\Throwable $e) {
            $this->getResponder()->serverErrorResponse();
        }

        return $this->getResponder()->respondOk();
    }

    private function getDeletePhoneService(): DeletePhoneService
    {
        return $this->deletePhoneService;
    }

    private function getResponder(): Responder
    {
        return $this->responder;
    }
}
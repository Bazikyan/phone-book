<?php


namespace App\Infrastructure\Http\Phones\Post;


use App\Application\CreatePhone\CreatePhoneRequest;
use App\Application\CreatePhone\CreatePhoneService;
use App\Domain\Model\Exception\PhoneExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class Action implements RequestHandlerInterface
{
    private CreatePhoneService $createPhoneService;

    private Responder $responder;

    public function __construct(CreatePhoneService $createPhoneService, Responder $responder)
    {
        $this->createPhoneService = $createPhoneService;
        $this->responder = $responder;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = json_decode($request->getBody()->getContents(), true);
        if (empty($body) || !isset($body['data']['attributes'])) {
            return $this->getResponder()->clientErrorResponse('Json data is invalid');
        }

        $attributes = $body['data']['attributes'];
        $firstName = $attributes['first_name'] ?? null;
        $lastName = $attributes['last_name'] ?? null;
        $phoneNumber = $attributes['phone_number'] ?? null;
        $countryCode = $attributes['country_code'] ?? null;
        $timezoneName = $attributes['timezone_name'] ?? null;
        if ($firstName === null || $phoneNumber === null) {
            return $this->getResponder()->clientErrorResponse('first_name and phone_number is required');
        }

        $createRequest = new CreatePhoneRequest(
            $firstName,
            $phoneNumber,
            $lastName,
            $countryCode,
            $timezoneName
        );

        try {
            $response = $this->getCreatePhoneService()->execute($createRequest);
        } catch (PhoneExceptionInterface $e) {
            return $this->getResponder()->clientErrorResponse($e->getMessage());
        } catch (Throwable $e) {
            return $this->getResponder()->serverErrorResponse();
        }

        return $this->getResponder()->respondOk($response->getId());
    }

    private function getCreatePhoneService(): CreatePhoneService
    {
        return $this->createPhoneService;
    }

    private function getResponder(): Responder
    {
        return $this->responder;
    }
}
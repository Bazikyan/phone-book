<?php


namespace App\Infrastructure\Http\Phones\Id\Patch;


use App\Application\UpdatePhone\Exception\InvalidAttributeException;
use App\Application\UpdatePhone\UpdatePhoneRequest;
use App\Application\UpdatePhone\UpdatePhoneService;
use App\Domain\Model\Exception\PhoneExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class Action implements RequestHandlerInterface
{

    private UpdatePhoneService $updatePhoneService;

    private Responder $responder;

    public function __construct(UpdatePhoneService $updatePhoneService, Responder $responder)
    {
        $this->updatePhoneService = $updatePhoneService;
        $this->responder = $responder;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = json_decode($request->getBody()->getContents(), true);
        if (empty($body) || !isset($body['data']['attributes'])) {
            return $this->getResponder()->clientErrorResponse('Json data is invalid');
        }
        $idFromUrl = $request->getAttribute('id');
        $id = $body['data']['id'] ?? null;
        if ($id === null) {
            return $this->getResponder()->clientErrorResponse('Phone identity required');
        }
        if ($id !== $idFromUrl) {
            return $this->getResponder()->clientErrorResponse('Phone identity is invalid');
        }

        $attributes = $body['data']['attributes'];

        try {
            $updateRequest = $this->createUpdateRequest($id, $attributes);
        } catch (InvalidAttributeException $e) {
            return $this->getResponder()->clientErrorResponse($e->getMessage());
        }

        try {
            $response = $this->getUpdatePhoneService()->execute($updateRequest);
        } catch (PhoneExceptionInterface $e) {
            return $this->getResponder()->clientErrorResponse($e->getMessage());
        } catch (Throwable $e) {
            return $this->getResponder()->serverErrorResponse();
        }

        return $this->getResponder()->respondOk($response->getId());
    }

    /**
     * @param $id
     * @param $attributes
     *
     * @return UpdatePhoneRequest
     *
     * @throws InvalidAttributeException
     */
    public function createUpdateRequest($id, $attributes): UpdatePhoneRequest
    {
        $updateRequest = new UpdatePhoneRequest($id);

        if (isset($attributes['first_name'])) {
            $updateRequest->addAttribute($updateRequest::ATTRIBUTE_FIRST_NAME, $attributes['first_name']);
        }
        if (isset($attributes['last_name'])) {
            $updateRequest->addAttribute($updateRequest::ATTRIBUTE_LAST_NAME, $attributes['last_name']);
        }
        if (isset($attributes['phone_number'])) {
            $updateRequest->addAttribute($updateRequest::ATTRIBUTE_PHONE_NUMBER, $attributes['phone_number']);
        }
        if (isset($attributes['country_code'])) {
            $updateRequest->addAttribute($updateRequest::ATTRIBUTE_COUNTRY_CODE, $attributes['country_code']);
        }
        if (isset($attributes['timezone_name'])) {
            $updateRequest->addAttribute($updateRequest::ATTRIBUTE_TIMEZONE_NAME, $attributes['timezone_name']);
        }

        return $updateRequest;
    }

    private function getUpdatePhoneService(): UpdatePhoneService
    {
        return $this->updatePhoneService;
    }

    private function getResponder(): Responder
    {
        return $this->responder;
    }
}
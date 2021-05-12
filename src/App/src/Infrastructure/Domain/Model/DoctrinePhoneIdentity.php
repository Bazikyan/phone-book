<?php


namespace App\Infrastructure\Domain\Model;


use App\Domain\Model\Exception\InvalidIdentityException;
use App\Domain\Model\PhoneIdentity;
use Ramsey\Uuid\Uuid;

class DoctrinePhoneIdentity implements PhoneIdentity
{
    private string $id;

    public function __construct(string $id)
    {
        $this->setId($id);
    }

    public function id(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @throws InvalidIdentityException
     */
    private function setId(string $id): void
    {
        try {
            Uuid::fromString($id);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidIdentityException("Provided Identity is invalid");
        }

        $this->id = $id;
    }

    public static function create(string $id = null): self
    {
        if ($id === null) {
            $id = Uuid::uuid4()->getHex();
        }

        return new self($id);
    }

    public function __toString(): string
    {
        return $this->id();
    }
}
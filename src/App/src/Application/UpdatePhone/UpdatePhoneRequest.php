<?php


namespace App\Application\UpdatePhone;


use App\Application\UpdatePhone\Exception\InvalidAttributeException;

class UpdatePhoneRequest
{
    private const ATTRIBUTE_LIST = [
        self::ATTRIBUTE_FIRST_NAME,
        self::ATTRIBUTE_LAST_NAME,
        self::ATTRIBUTE_PHONE_NUMBER,
        self::ATTRIBUTE_COUNTRY_CODE,
        self::ATTRIBUTE_TIMEZONE_NAME,
    ];
    private const NOT_NULL_ATTRIBUTE_LIST = [
        self::ATTRIBUTE_FIRST_NAME,
        self::ATTRIBUTE_PHONE_NUMBER,
    ];
    public const ATTRIBUTE_FIRST_NAME = 'first_name';
    public const ATTRIBUTE_LAST_NAME = 'last_name';
    public const ATTRIBUTE_PHONE_NUMBER = 'phone_number';
    public const ATTRIBUTE_COUNTRY_CODE = 'country_code';
    public const ATTRIBUTE_TIMEZONE_NAME = 'timezone_name';

    private string $id;

    private array $attributes;

    public function __construct(string $id) {
        $this->id = $id;
        $this->attributes = [];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function addAttribute(string $name, ?string $value): void
    {
        if (!in_array($name, self::ATTRIBUTE_LIST)) {
            throw new InvalidAttributeException(
                'Invalid attribute provided, allowed attributes are: '
                . implode(', ', self::ATTRIBUTE_LIST)
            );
        }

        if (in_array($name, self::NOT_NULL_ATTRIBUTE_LIST) && $value === null) {
            throw new InvalidAttributeException("Provided attribute can not by null: $name");
        }

        $this->attributes[ $name ] = $value;
    }

    public function removeAttribute(string $name): void
    {
        unset($this->attributes[$name]);
    }

    public function getAttribute(string $name): ?string
    {
        if (!$this->hasAttribute($name)) {
            throw new InvalidAttributeException('Provided attribute does not exists');
        }

        return $this->attributes[ $name ];
    }

    public function hasAttribute(string $name): bool
    {
        return isset($this->attributes[ $name ]);
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }


}
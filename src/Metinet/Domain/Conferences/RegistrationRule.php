<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class RegistrationRule
{
    private $allowExternalPeople;
    private $externalPeopleEntrancePrice;

    public static function reservedToStudent(): self
    {
        return new self(false, null);
    }

    public static function allowExternalPeopleToRegisterToConference(Price $price): self
    {
        return new self(true, $price);
    }

    private function __construct(bool $allowExternalPeople, ?Price $externalPeopleEntrancePrice = null)
    {
        $this->allowExternalPeople = $allowExternalPeople;
        $this->externalPeopleEntrancePrice = $externalPeopleEntrancePrice;
    }

    public function areExternalPeopleAllowed(): bool
    {
        return $this->allowExternalPeople;
    }

    public function getExternalPeopleEntrancePrice(): ?Price
    {
        return $this->externalPeopleEntrancePrice;
    }
}

<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class Location
{
    private $placeName;
    private $address;
    public function __construct(string $placeName, PostalAddress $address)
    {
        $this->address = $address;
        $this->placeName = $placeName;
    }
    public function getPlaceName(): string
    {
        return $this->placeName;
    }
    public function getAddress(): PostalAddress
    {
        return $this->address;
    }
}

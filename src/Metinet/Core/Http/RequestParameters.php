<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Http;

class RequestParameters implements \IteratorAggregate
{
    private $requestParameters;

    public function __construct(array $requestParameters)
    {
        $this->requestParameters = $requestParameters;
    }

    public function get($name, $default = null)
    {
        return $this->requestParameters[$name] ?? $default;
    }

    public function getIterator(): iterable
    {
        return $this->requestParameters;
    }
}

<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class InvalidConferenceDate extends \Exception
{
    public static function mustNotBeInThePast(): self
    {
        return new self('Conference date cannot be in the past');
    }
}

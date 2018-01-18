<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class MaxAttendeesReached extends \Exception
{
    public function __construct(int $maxAttendees)
    {
        parent::__construct(sprintf('Max attendees reached (max: %d)', $maxAttendees));
    }
}

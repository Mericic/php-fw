<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class TimeSlot
{
    private $start;
    private $end;

    public function __construct(Time $start, Time $end)
    {
        // check if $start is greather than $end

        $this->start = $start;
        $this->end = $end;
    }

    public function getStart(): Time
    {
        return $this->start;
    }

    public function getEnd(): Time
    {
        return $this->end;
    }

    public function getDuration(): Time
    {
        $startDate = $this->getDateTimeFromTime($this->start);
        $endDate = $this->getDateTimeFromTime($this->end);
        $dateDiff = $endDate->diff($startDate);

        return new Time($dateDiff->h, $dateDiff->i, $dateDiff->s);
    }
}

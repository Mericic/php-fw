<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 17/01/2018
 * Time: 16:50
 */

namespace Metinet\Domain\Events;


class EventDate
{
    private $date;

    public static function fromString(string $date): self
    {
        return new self($date);
    }


    private function __construct(string $date)
    {
        $dateAsDateTime = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s 23:59:59', $date));


        $this->date = $dateAsDateTime;
    }
}
<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class Time
{
    private $hour;
    private $minute;
    private $second;

    public function __construct(int $hour = 0, int $minute = 0, int $second = 0)
    {
//        Ensure::between($hour, 0, 23, 'Hour must be between 0 and 23');
//        Ensure::between($minute, 0, 59, 'Minute must be between 0 and 60');
//        Ensure::between($second, 0, 59, 'Second must be between 0 and 60');

        $this->hour = $hour;
        $this->minute = $minute;
        $this->second = $second;
    }

    public function __toString(): string
    {
        return sprintf('%02d:%02d:%02d', $this->hour, $this->minute, $this->second);
    }

    public static function fromString(string $time): self
    {
        [$hour, $minute, $second] = explode(':', $time, 3) + [0, 0, 0];

        return new self((int)$hour, (int)$minute, (int)$second);
    }

    public function getHour(): int
    {
        return $this->hour;
    }

    public function getMinute(): int
    {
        return $this->minute;
    }

    public function getSecond(): int
    {
        return $this->second;
    }
}

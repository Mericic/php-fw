<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class ConferenceDetails
{
    private $name;
    private $description;
    private $goals;

    public function __construct(string $name, string $description, array $goals)
    {
        $this->name = $name;
        $this->description = $description;
        $this->goals = $goals;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getGoals(): array
    {
        return $this->goals;
    }
}

<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Infrastructure\Repositories;

use Metinet\Domain\Conferences\Conference;
use Metinet\Domain\Conferences\ConferenceNotFound;
use Metinet\Domain\Conferences\ConferenceRepository;

class InMemoryConferenceRepository implements ConferenceRepository
{
    private $conferences = [];

    public function save(Conference $conference): void
    {
        $this->conferences[$conference->getId()] = $conference;
    }

    public function get($id): Conference
    {
        if (!isset($this->conferences[$id])) {

            throw new ConferenceNotFound($id);
        }

        return $this->conferences[$id];
    }
}

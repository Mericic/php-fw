<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Infrastructure\Repositories;

use Metinet\Domain\Conferences\Conference;
use Metinet\Domain\Conferences\ConferenceNotFound;
use Metinet\Domain\Conferences\ConferenceRepository;

class FilesystemConferenceRepository implements ConferenceRepository
{
    private const DATA_PATH = '/var/data/conferences/';

    public function save(Conference $conference): void
    {
        file_put_contents(sprintf('%s.conference', $conference->getId()), serialize($conference));
    }

    public function get($id): Conference
    {
        $filename = sprintf('%s.conference', $id);

        if (!is_file($filename)) {

            throw new ConferenceNotFound($id);
        }

        return file_get_contents($filename);
    }
}

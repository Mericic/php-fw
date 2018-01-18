<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

interface ConferenceRepository
{
    public function save(Conference $conference): void;
    public function get($id): Conference;
}

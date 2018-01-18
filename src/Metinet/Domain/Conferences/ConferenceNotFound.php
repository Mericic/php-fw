<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class ConferenceNotFound extends \Exception
{
    public function __construct($id)
    {
        parent::__construct(sprintf('Conference with id "%s" not found.', $id));
    }
}

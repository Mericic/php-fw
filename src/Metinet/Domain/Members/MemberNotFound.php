<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Members;

use Metinet\Domain\Conferences\Email;

class MemberNotFound extends \Exception
{
    public static function unknownEmail(Email $email): self
    {
        return new self(sprintf('Member with e-mail "%s" not found.', $email));
    }
}

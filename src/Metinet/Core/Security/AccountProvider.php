<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

use Metinet\Domain\Conferences\Email;

interface AccountProvider
{
    public function findByUsername(Email $email): Account;
}

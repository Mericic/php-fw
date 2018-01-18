<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

class AccountNotFound extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('No account found for e-mail: "%s"', $email));
    }
}

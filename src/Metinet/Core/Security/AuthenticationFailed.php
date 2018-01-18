<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

use Metinet\Domain\Conferences\Email;

class AuthenticationFailed extends \Exception
{
    public static function invalidPassword(Account $account)
    {
        return new self(sprintf('Account "%s" failed to authenticate, invalid password provided', $account->getEmail()));
    }
    public static function accountNotFound(Email $email)
    {
        return new self(sprintf('Account with email "%s" was not found.', (string) $email));
    }
}

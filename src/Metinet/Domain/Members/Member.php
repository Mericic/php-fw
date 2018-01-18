<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Members;

use Metinet\Core\Security\Account;
use Metinet\Core\Security\EncodedPassword;
use Metinet\Domain\Conferences\Email;

class Member implements Account
{
    private $email;
    private $encodedPassword;

    private function __construct(Email $email, EncodedPassword $encodedPassword)
    {
        $this->email = $email;
        $this->encodedPassword = $encodedPassword;
    }

    public static function register(Email $email, EncodedPassword $encodedPassword): self
    {
        return new self($email, $encodedPassword);
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function getEncodedPassword(): EncodedPassword
    {
        return $this->encodedPassword;
    }
}

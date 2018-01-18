<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

use Metinet\Core\Session\Session;

class AuthenticationContext
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function isAccountLoggedIn(): bool
    {
        return $this->session->get('account') instanceof Account;
    }

    public function getAccount(): Account
    {
        if (!$this->isAccountLoggedIn()) {

            throw new \RuntimeException('No Account logged in.');
        }

        return $this->session->get('account');
    }

    public function logout(): void
    {
        $this->session->remove('account');
    }
}

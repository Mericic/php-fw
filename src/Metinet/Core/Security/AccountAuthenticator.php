<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

use Metinet\Core\Session\Session;
use Metinet\Domain\Conferences\Email;

class AccountAuthenticator
{
    private $accountProvider;
    private $passwordEncoder;
    private $session;

    public function __construct(AccountProvider $accountProvider, PasswordEncoder $passwordEncoder, Session $session)
    {
        $this->accountProvider  = $accountProvider;
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }

    public function authenticate(Email $email, $password): void
    {
        try {
            $account = $this->accountProvider->findByUsername($email);
        } catch (AccountNotFound $e) {

            throw AuthenticationFailed::accountNotFound($email);
        }

        $providedEncodedPassword = $this->passwordEncoder
            ->encode($password, $account->getEncodedPassword()->getSalt())
        ;

        if ((string) $account->getEncodedPassword() !== (string) $providedEncodedPassword) {

            throw AuthenticationFailed::invalidPassword($account);
        }

        $this->session->set('account', $account);
    }
}

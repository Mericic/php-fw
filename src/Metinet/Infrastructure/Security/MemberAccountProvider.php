<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Infrastructure\Security;

use Metinet\Core\Security\Account;
use Metinet\Core\Security\AccountNotFound;
use Metinet\Core\Security\AccountProvider;
use Metinet\Domain\Conferences\Email;
use Metinet\Domain\Members\MemberNotFound;
use Metinet\Domain\Members\MemberRepository;

class MemberAccountProvider implements AccountProvider
{
    private $repository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->repository = $memberRepository;
    }

    public function findByUsername(Email $email): Account
    {
        try {
            return $this->repository->findByEmail($email);
        } catch (MemberNotFound $e) {

            throw new AccountNotFound((string) $email);
        }
    }
}

<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Infrastructure\Repositories;

use Metinet\Core\Security\EncodedPassword;
use Metinet\Core\Security\PlainTextPasswordEncoder;
use Metinet\Domain\Conferences\Email;
use Metinet\Domain\Members\Member;
use Metinet\Domain\Members\MemberNotFound;
use Metinet\Domain\Members\MemberRepository;

class InMemoryMemberRepository implements MemberRepository
{
    private $members = [];

    public function __construct()
    {
        $passwordEncoder = new PlainTextPasswordEncoder();
        $this->save(Member::register(
            new Email('guery.b@gmail.com'),
            $passwordEncoder->encode('a', 'pepper')
        ));
    }

    public function save(Member $member): void
    {
        $this->members[$member->getEmail()] = $member;
    }

    public function findByEmail(Email $email): Member
    {
        foreach ($this->members as $id => $member) {
            if ($id === (string) $email) {

                return $this->members[$id];
            }
        }

        throw new MemberNotFound($email);
    }
}

<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Members;

use Metinet\Domain\Conferences\Email;

interface MemberRepository
{
    public function save(Member $member): void;
    public function findByEmail(Email $email): Member;
}

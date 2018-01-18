<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

class Sha1PasswordEncoder implements PasswordEncoder
{
    private $iterationCount;

    public function __construct(int $iterationCount)
    {
        $this->iterationCount = $iterationCount;
    }

    public function encode(string $password, string $salt): EncodedPassword
    {
        for ($i = 0, $hashedPassword = $password; $i < $this->iterationCount; ++$i) {
            $hashedPassword = sha1($hashedPassword);
        }

        return new EncodedPassword(sprintf('%s{%s}', $hashedPassword, $salt), $salt);
    }
}

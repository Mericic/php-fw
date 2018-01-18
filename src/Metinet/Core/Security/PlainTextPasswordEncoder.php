<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

class PlainTextPasswordEncoder implements PasswordEncoder
{
    public function encode(string $password, string $salt): EncodedPassword
    {
        return new EncodedPassword(sprintf('%s{%s}', $password, $salt), $salt);
    }
}

<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

interface PasswordEncoder
{
    public function encode(string $password, string $salt): EncodedPassword;
}

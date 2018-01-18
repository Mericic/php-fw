<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Security;

interface Account
{
    public function getEmail(): string;
    public function getEncodedPassword(): EncodedPassword;
}

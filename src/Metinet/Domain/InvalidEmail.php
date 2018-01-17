<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 17/01/2018
 * Time: 15:55
 */

namespace Metinet\Domain;


class InvalidEmail extends \Exception
{
    public static function wrongEmail(string $email): self
    {
        return new self(sprintf('%s is not a correct email', $email));
    }
}
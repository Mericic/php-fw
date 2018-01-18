<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2018
 * Time: 11:16
 */

namespace Metinet\Domain;


class InvalidPassword extends \Exception
{
    public static function wrongPassword(): self
    {
        return new self(sprintf("we don't accept this type of password. Checks it has no white space, at least one letter, one special character, one number, and more than 8 characters"));
    }
}
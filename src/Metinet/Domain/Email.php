<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 17/01/2018
 * Time: 15:52
 */

namespace Metinet\Domain;


class Email
{
    private $email;

    /**
     * Email constructor.
     * @param $email
     */
    public static function valide($email):string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmail::wrongEmail($email) ;
        }

        return $email;
    }

}
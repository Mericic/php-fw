<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2018
 * Time: 11:16
 */

namespace Metinet\Domain;


class Password
{
    private $password;

    /**
     * Password constructor.
     * @param $password
     */
    public function __construct(string $password)
    {
        if(!preg_match('@[a-z]@', $password)
            || !preg_match('@[0-9]@', $password)
            || preg_match('@["/\\s/"]@', $password)
            || !preg_match('@[\W]+@', $password)
            || strlen($password)<8){
            throw InvalidPassword::wrongPassword();
        }

        $this->password = password_hash($password,PASSWORD_DEFAULT);
    }

    public function __toString()
    {
        return $this->password;
    }

    public function getPassword():string{
        return $this->password;
    }

}
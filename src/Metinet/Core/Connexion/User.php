<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2018
 * Time: 09:45
 */
namespace Metinet\Core\Connexion;
use Metinet\Domain\Email;
use Metinet\Domain\InvalidEmail;
use Metinet\Domain\Password;

class User
{
    private $email;
    private $password;

    /**
     * User constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = Email::valide($email);
        $passHache = new Password($password);
        $this->password = $passHache->getPassword();
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

}
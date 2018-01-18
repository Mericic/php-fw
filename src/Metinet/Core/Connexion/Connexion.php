<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2018
 * Time: 09:45
 */

namespace Metinet\Core\Connexion;

use Metinet\Core\Connexion\User;


class Connexion
{
    private $userCollection;

    /**
     * Connexion constructor.
     * @param $user
     * @param $userCollection
     */
    public function __construct(array $userCollection)
    {
        foreach($userCollection as $users){
            if(!$users instanceof User)
                throw new \LogicException('Invalid item provided, must be an instance of Participant');

        }
        $this->userCollection = $userCollection;
    }


    public function connectUser(string $email, string $passowrd):User{
        foreach($this->userCollection as $utilisateur){
            if($utilisateur->getEmail()===$email && password_verify($passowrd, $utilisateur->getPassword())){
                echo 'co ok';
                return new User($email, $passowrd);
            }
        }
        throw InvalidConnexion::wrongPassOrWrongEmail();

    }
}
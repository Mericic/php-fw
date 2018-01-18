<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2018
 * Time: 10:09
 */

namespace Metinet\Core\Connexion;
use Metinet\Core\Connexion\User;


class UserCollection
{
    private $userCollection=[];

    /**
     * UserCollection constructor.
     * @param $userCollection
     */
    public function __construct(array $userCollection = [])
    {
        $this->userCollection = $userCollection;
    }

    /**
     * @return array
     */
    public function getUserCollection(): array
    {
        return $this->userCollection;
    }

    public function add(User $user):void{
        $this->userCollection[] = $user;
    }

    public function all():array{
        return $this->userCollection;
    }


}
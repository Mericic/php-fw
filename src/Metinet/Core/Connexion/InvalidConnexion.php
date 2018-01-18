<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2018
 * Time: 10:04
 */

namespace Metinet\Core\Connexion;


class InvalidConnexion Extends \Exception
{


    public static function wrongPassOrWrongEmail(): self
    {
        return new self('Mot de passe ou email faux');
    }
}
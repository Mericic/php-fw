<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 17/01/2018
 * Time: 14:22
 */

namespace Metinet\Domain\Events;
use Metinet\Domain\Email;

class Participant
{
    private $nom;
    private $prenom;
    private $etudiant;
    private $payement;
    private $email;

    /**
     * Participant constructor.
     * @param $nom
     * @param $prenom
     * @param $etudiant
     */
    public function __construct(string $nom, string $prenom, string $email, bool $etudiant=true, bool $payement = false)
    {
        $this->email = Email::valide($email);
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->etudiant = $etudiant;
        $this->payement = $payement;
    }

    public function isPayed():bool{
        if($this->etudiant == false && $this->payement == false){
            return false;
        }
        return true;
    }

    public function toString():string{
        return $this->nom.' '.$this->prenom;
    }


    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return bool
     */
    public function isEtudiant(): bool
    {
        return $this->etudiant;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }




}
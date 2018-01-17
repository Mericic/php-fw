<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 17/01/2018
 * Time: 11:55
 */

namespace Metinet\Domain\Events;


class Salle
{
    private $nombreMaxOccupants;
    private $nombreOccupants;
    private $nomSalle;
    private $addresse;

    /**
     * Salle constructor.
     * @param $nombreMaxOccupants
     * @param $nomSalle
     * @param $addresse
     */
    public function __construct(int $nombreMaxOccupants, int $nombreOccupants = 0,String $nomSalle, String $addresse)
    {
        $this->nombreMaxOccupants = $nombreMaxOccupants;
        $this->nomSalle = $nomSalle;
        $this->addresse = $addresse;
        $this->nombreOccupants = $nombreOccupants;
    }

    public function addOccupant(int $nombreOccupants=1):void{
        if(($nombreOccupants+$this->nombreOccupants)>$this->nombreMaxOccupants){
            throw new \Exception("trop de monde dans cette salle");
        }
        $this->nombreOccupants+=$nombreOccupants;
    }

    /**
     * @return int
     */
    public function getNombreOccupants(): int
    {
        return $this->nombreOccupants;
    }

    /**
     * @return int
     */
    public function getNombreMaxOccupants(): int
    {
        return $this->nombreMaxOccupants;
    }

    /**
     * @return String
     */
    public function getNomSalle(): String
    {
        return $this->nomSalle;
    }

    /**
     * @return String
     */
    public function getAddresse(): String
    {
        return $this->addresse;
    }




}
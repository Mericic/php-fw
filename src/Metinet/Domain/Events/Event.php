<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 17/01/2018
 * Time: 11:34
 */

namespace Metinet\Domain\Events;
use Metinet\Domain\Events\Salle;


class Event
{
    private $description;
    private $Objectifs;
    private $Salle;
    private $ParticipantsCollection;
    private $date;
    private $eventPrive;
    private $price;
    /**
     * Event constructor.
     * @param $description
     * @param $ObjectifCollection
     * @param $Salle
     * @param $EtudiantCollection
     */
    public function __construct($date, String $description ='', array $Objectifs =[], Salle $Salle, array $ParticipantCollection=[], bool $eventPrive=false, float $price =0)
    {
        foreach ($ParticipantCollection as $key=>$Participant) {
            if (!$Participant instanceof Participant) {

                throw new \LogicException('Invalid item provided, must be an instance of Participant');
            }
            if(!$Participant->isEtudiant() && $eventPrive){
                unset($ParticipantCollection[$key]);
            }
        }

        if (!$Salle instanceof Salle) {

            throw new \LogicException('Invalid item provided, must be an instance of String');
        }

        if($eventPrive){
            if($price>0)
                $this->price = $price;
        }

        $this->description = $description;
        $this->ObjectifCollection = $Objectifs;
        $this->Salle = $Salle;
        $this->Salle->addOccupant(count($ParticipantCollection));
        $this->ParticipantsCollection = $ParticipantCollection;
        $this->date = $date;
        $this->eventPrive = $eventPrive;
    }

    public function getValidated():array{
        $readyToGo=[];
        foreach($this->ParticipantsCollection as $participant){
            if($participant->isPayed()){
                $readyToGo[] = $participant->toString();
            }
        }
        return $readyToGo;
    }

    public function getUnpayed(): array{
        $unpayed = [];
        foreach($this->ParticipantsCollection as $participant){
            if(!$participant->isPayed()){
                $unpayed[] = $participant->toString();
            }
        }
        return $unpayed;
    }

    public function inscription(Participant $participant, bool $payed = false){
        if(!$participant->isEtudiant() && $this->eventPrive){
            throw new \Exception("Les étrangers (au site) ne sont pas acceptés ici");
        }
        if(!$participant->isEtudiant()){
            $this->payed=$payed;
        }
        $this->Salle->addOccupant();

    }

    public function toPay($email){
        //I have no idea how to do that
    }

    public function setPrivate():void{
        $this->eventPrive = true;
        foreach ($this->ParticipantsCollection as $key=>$Participant) {
            if(!$Participant->isEtudiant() && $this->eventPrive){
                unset($this->ParticipantsCollection[$key]);
            }
        }
    }

    public function setPublic():void{
        $this->eventPrive = false;
    }
    /**
     * @return String
     */
    public function getDescription(): String
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription(String $description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getObjectifs()
    {
        return $this->Objectifs;
    }

    /**
     * @param mixed $Objectifs
     */
    public function setObjectifs($Objectifs)
    {
        $this->Objectifs = $Objectifs;
    }

    /**
     * @return Salle
     */
    public function getSalle(): Salle
    {
        return $this->Salle;
    }

    /**
     * @param Salle $Salle
     */
    public function setSalle(Salle $Salle)
    {
        $this->Salle = $Salle;
    }

    /**
     * @return mixed
     */
    public function getEtudiants()
    {
        return $this->Etudiants;
    }

    /**
     * @param mixed $Etudiants
     */
    public function setEtudiants($Etudiants)
    {
        $this->Etudiants = $Etudiants;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



}
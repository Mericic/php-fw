<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 17/01/2018
 * Time: 14:31
 */

namespace Metinet\Domain\Events;
use Metinet\Domain\Events\Participant;


class ParticipantCollection
{
    private $participants = [];

    /**
     * StudentCollection constructor.
     * @param $student
     */
    public function __construct(array $participants)
    {
        foreach ($participants as $key=>$participant) {
            if (!$participant instanceof Participant) {

                throw new \LogicException('Invalid item provided, must be an instance of Participant');
            }
            if(!$participant->isEtudiant() && !$participant->isPayed()){
                unset($participants[$key]);
            }
        }
        $this->participants = $participants;
    }

    public function add(Student $participants): void{
        $this->participants = $participants;
    }


    public function all(): array
    {
        return $this->participants;
    }
}
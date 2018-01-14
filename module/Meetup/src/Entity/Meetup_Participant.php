<?php


namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;


class Meetup_Participant{
    /**
     * @ORM\ManyToOne(targetEntity="Meetup")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Meetup;

    /**
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Participant;

    /**
     * @return mixed
     */
    public function getMeetup()
    {
        return $this->Meetup;
    }

    /**
     * @param mixed $Meetup
     */
    public function setMeetup($Meetup)
    {
        $this->Meetup = $Meetup;
    }

    /**
     * @return mixed
     */
    public function getParticipant()
    {
        return $this->Participant;
    }

    /**
     * @param mixed $Participant
     */
    public function setParticipant($Participant)
    {
        $this->Participant = $Participant;
    }

    public function __construct($meetup, $participant)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->meetup = $meetup;
        $this->participant = $participant;
    }
}

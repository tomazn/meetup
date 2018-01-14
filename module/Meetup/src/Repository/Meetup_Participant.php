<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Meetup\Entity\Participant;
use Doctrine\ORM\EntityRepository;
use Meetup\Entity\Meetup_Participant;

final class MeetupParticipantRepository extends EntityRepository
{

    public function add($meetupParticipant) : void
    {
        $this->getEntityManager()->persist($meetupParticipant);
        $this->getEntityManager()->flush($meetupParticipant);
    }


    public function get($id)
    {
        $meetupParticipant = $this->getEntityManager()->getRepository(Meetup_Participant::class)->find($id);
        return $meetupParticipant;
    }

    public function createMeetupParticipant(Meetup $meetup, Participant $participant)
    {
        return new Meetup_Participant($meetup,$participant);
    }
}

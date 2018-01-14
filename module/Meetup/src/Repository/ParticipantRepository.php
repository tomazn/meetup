<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;
use Meetup\Entity\Participant;

final class ParticipantRepository extends EntityRepository
{

    public function add($participant) : void
    {
        $this->getEntityManager()->persist($participant);
        $this->getEntityManager()->flush($participant);
    }

    public function edit($participant) : void
    {
        $this->getEntityManager()->persist($participant);
        $this->getEntityManager()->flush($participant);
    }

    public function delete($participant) : void
    {
        $this->getEntityManager()->remove($participant);
        $this->getEntityManager()->flush();
    }

    public function get($id)
    {
        $participant = $this->getEntityManager()->getRepository(Participant::class)->find($id);
        return $participant;
    }

    public function createParticipant(string $name, string $job)
    {
        return new Participant($name,$job);
    }
}

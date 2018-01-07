<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;

final class MeetupRepository extends EntityRepository
{

    public function add($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function edit($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function delete($meetup) : void
    {
        $this->getEntityManager()->remove($meetup);
        $this->getEntityManager()->flush();
    }

    public function get($id) : Meetup
    {
        $meetup = $this->getEntityManager()->getRepository(Meetup::class)->find($id);
        return $meetup;
    }

    public function createMeetup(string $title, string $description = '', \DateTime $start, \DateTime $end)
    {
        return new Meetup($title,$description,$start,$end);
    }
}

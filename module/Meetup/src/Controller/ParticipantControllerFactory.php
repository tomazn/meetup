<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Participant;
use Meetup\Form\ParticipantForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class ParticipantControllerFactory
{
    public function __invoke(ContainerInterface $container) : ParticipantController
    {
        $participantRepository = $container->get(EntityManager::class)->getRepository(Participant::class);
        $participantForm = $container->get(ParticipantForm::class);

        return new ParticipantController($participantRepository, $participantForm);
    }
}

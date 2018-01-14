<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;
/**
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\ParticipantRepository")
 * @ORM\Table(name="participant")
 */
class Participant
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;


    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $job;

    /**
     * @return mixed
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param mixed $job
     */
    public function setJob($job)
    {
        $this->job = $job;
    }

    public function __construct(string $name = '', string $job)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->job = $job;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}

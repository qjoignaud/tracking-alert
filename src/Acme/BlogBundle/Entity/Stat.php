<?php

namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BlogBundle\Entity\StatRepository")
 */
class Stat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="notif_type", type="string", length=255)
     */
    private $notifType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set notifType
     *
     * @param string $notifType
     *
     * @return Stat
     */
    public function setNotifType($notifType)
    {
        $this->notifType = $notifType;

        return $this;
    }

    /**
     * Get notifType
     *
     * @return string
     */
    public function getNotifType()
    {
        return $this->notifType;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Stat
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}


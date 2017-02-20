<?php

namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Param
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BlogBundle\Entity\ParamRepository")
 */
class Param
{
    
    /**
     * @ORM\ManyToOne(targetEntity="Acme\BlogBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled_email", type="boolean")
     */
    private $isEnabledEmail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled_emailUrgent", type="boolean")
     */
    private $isEnabledEmailUrgent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled_sms", type="boolean")
     */
    private $isEnabledSms;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority_id", type="integer")
     */
    private $priorityId;

    /**
     * @var string
     *
     * @ORM\Column(name="category_id", type="string", length=255)
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="severity_id", type="string", length=255)
     */
    private $severityId;

    /**
     * @var string
     *
     * @ORM\Column(name="status_id", type="string", length=255)
     */
    private $statusId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_type", type="string", length=255)
     */
    private $eventType;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer")
     */
    private $projectId;


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
     * Set isEnabledEmail
     *
     * @param boolean $isEnabledEmail
     *
     * @return Param
     */
    public function setIsEnabledEmail($isEnabledEmail)
    {
        $this->isEnabledEmail = $isEnabledEmail;

        return $this;
    }

    /**
     * Get isEnabledEmail
     *
     * @return boolean
     */
    public function getIsEnabledEmail()
    {
        return $this->isEnabledEmail;
    }

    /**
     * Set isEnabledEmailUrgent
     *
     * @param boolean $isEnabledEmailUrgent
     *
     * @return Param
     */
    public function setIsEnabledEmailUrgent($isEnabledEmailUrgent)
    {
        $this->isEnabledEmailUrgent = $isEnabledEmailUrgent;

        return $this;
    }

    /**
     * Get isEnabledEmailUrgent
     *
     * @return boolean
     */
    public function getIsEnabledEmailUrgent()
    {
        return $this->isEnabledEmailUrgent;
    }

    /**
     * Set isEnabledSms
     *
     * @param boolean $isEnabledSms
     *
     * @return Param
     */
    public function setIsEnabledSms($isEnabledSms)
    {
        $this->isEnabledSms = $isEnabledSms;

        return $this;
    }

    /**
     * Get isEnabledSms
     *
     * @return boolean
     */
    public function getIsEnabledSms()
    {
        return $this->isEnabledSms;
    }

    /**
     * Set priorityId
     *
     * @param integer $priorityId
     *
     * @return Param
     */
    public function setPriorityId($priorityId)
    {
        $this->priorityId = $priorityId;

        return $this;
    }

    /**
     * Get priorityId
     *
     * @return integer
     */
    public function getPriorityId()
    {
        return $this->priorityId;
    }

    /**
     * Set categoryId
     *
     * @param string $categoryId
     *
     * @return Param
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return string
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set severityId
     *
     * @param string $severityId
     *
     * @return Param
     */
    public function setSeverityId($severityId)
    {
        $this->severityId = $severityId;

        return $this;
    }

    /**
     * Get severityId
     *
     * @return string
     */
    public function getSeverityId()
    {
        return $this->severityId;
    }

    /**
     * Set statusId
     *
     * @param string $statusId
     *
     * @return Param
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * Get statusId
     *
     * @return string
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set eventType
     *
     * @param string $eventType
     *
     * @return Param
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * Get eventType
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Set projectId
     *
     * @param integer $projectId
     *
     * @return Param
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get projectId
     *
     * @return integer
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Set user
     *
     * @param \Acme\BlogBundle\Entity\User $user
     *
     * @return Param
     */
    public function setUser(\Acme\BlogBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\BlogBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

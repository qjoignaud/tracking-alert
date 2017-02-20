<?php

namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BlogBundle\Entity\AccountRepository")
 */
class Account
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
     * @var string
     *
     * @ORM\Column(name="bt_login", type="string", length=255)
     */
    private $btLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="bt_pwd", type="string", length=255)
     */
    private $btPwd;

    /**
     * @var string
     *
     * @ORM\Column(name="bt_name", type="string", length=255)
     */
    private $btName;

    /**
     * @var string
     *
     * @ORM\Column(name="secondary_email_address", type="string", length=255)
     */
    private $secondaryEmailAddress;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled_email", type="boolean")
     */
    private $isEnabledEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="token_email", type="string", length=255)
     */
    private $tokenEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="isExpired_email", type="datetime")
     */
    private $isExpiredEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone_number", type="integer")
     */
    private $phoneNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled_phone", type="boolean")
     */
    private $isEnabledPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="token_phone", type="string", length=255)
     */
    private $tokenPhone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="isExpired_phone", type="datetime")
     */
    private $isExpiredPhone;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="access_level", type="integer")
     */
    private $accessLevel;


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
     * Set btLogin
     *
     * @param string $btLogin
     *
     * @return Account
     */
    public function setBtLogin($btLogin)
    {
        $this->btLogin = $btLogin;

        return $this;
    }

    /**
     * Get btLogin
     *
     * @return string
     */
    public function getBtLogin()
    {
        return $this->btLogin;
    }

    /**
     * Set btPwd
     *
     * @param string $btPwd
     *
     * @return Account
     */
    public function setBtPwd($btPwd)
    {
        $this->btPwd = $btPwd;

        return $this;
    }

    /**
     * Get btPwd
     *
     * @return string
     */
    public function getBtPwd()
    {
        return $this->btPwd;
    }

    /**
     * Set btName
     *
     * @param string $btName
     *
     * @return Account
     */
    public function setBtName($btName)
    {
        $this->btName = $btName;

        return $this;
    }

    /**
     * Get btName
     *
     * @return string
     */
    public function getBtName()
    {
        return $this->btName;
    }

    /**
     * Set secondaryEmailAddress
     *
     * @param string $secondaryEmailAddress
     *
     * @return Account
     */
    public function setSecondaryEmailAddress($secondaryEmailAddress)
    {
        $this->secondaryEmailAddress = $secondaryEmailAddress;

        return $this;
    }

    /**
     * Get secondaryEmailAddress
     *
     * @return string
     */
    public function getSecondaryEmailAddress()
    {
        return $this->secondaryEmailAddress;
    }

    /**
     * Set isEnabledEmail
     *
     * @param boolean $isEnabledEmail
     *
     * @return Account
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
     * Set tokenEmail
     *
     * @param string $tokenEmail
     *
     * @return Account
     */
    public function setTokenEmail($tokenEmail)
    {
        $this->tokenEmail = $tokenEmail;

        return $this;
    }

    /**
     * Get tokenEmail
     *
     * @return string
     */
    public function getTokenEmail()
    {
        return $this->tokenEmail;
    }

    /**
     * Set isExpiredEmail
     *
     * @param boolean $isExpiredEmail
     *
     * @return Account
     */
    public function setIsExpiredEmail($isExpiredEmail)
    {
        $this->isExpiredEmail = $isExpiredEmail;

        return $this;
    }

    /**
     * Get isExpiredEmail
     *
     * @return boolean
     */
    public function getIsExpiredEmail()
    {
        return $this->isExpiredEmail;
    }

    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     *
     * @return Account
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return integer
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set isEnabledPhone
     *
     * @param boolean $isEnabledPhone
     *
     * @return Account
     */
    public function setIsEnabledPhone($isEnabledPhone)
    {
        $this->isEnabledPhone = $isEnabledPhone;

        return $this;
    }

    /**
     * Get isEnabledPhone
     *
     * @return boolean
     */
    public function getIsEnabledPhone()
    {
        return $this->isEnabledPhone;
    }

    /**
     * Set tokenPhone
     *
     * @param string $tokenPhone
     *
     * @return Account
     */
    public function setTokenPhone($tokenPhone)
    {
        $this->tokenPhone = $tokenPhone;

        return $this;
    }

    /**
     * Get tokenPhone
     *
     * @return string
     */
    public function getTokenPhone()
    {
        return $this->tokenPhone;
    }

    /**
     * Set isExpiredPhone
     *
     * @param boolean $isExpiredPhone
     *
     * @return Account
     */
    public function setIsExpiredPhone($isExpiredPhone)
    {
        $this->isExpiredPhone = $isExpiredPhone;

        return $this;
    }

    /**
     * Get isExpiredPhone
     *
     * @return boolean
     */
    public function getIsExpiredPhone()
    {
        return $this->isExpiredPhone;
    }

    /**
     * Set accessLevel
     *
     * @param integer $accessLevel
     *
     * @return Account
     */
    public function setAccessLevel($accessLevel)
    {
        $this->accessLevel = $accessLevel;

        return $this;
    }

    /**
     * Get accessLevel
     *
     * @return integer
     */
    public function getAccessLevel()
    {
        return $this->accessLevel;
    }

    /**
     * Set user
     *
     * @param \Acme\BlogBundle\Entity\User $user
     *
     * @return Account
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

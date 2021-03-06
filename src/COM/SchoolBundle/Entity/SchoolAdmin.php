<?php

namespace COM\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolAdmin
 *
 * @ORM\Table(name="sl_school_admin")
 * @ORM\Entity(repositoryClass="COM\SchoolBundle\Entity\SchoolAdminRepository")
 */
class SchoolAdmin
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
	 * @ORM\ManyToOne(targetEntity="COM\SchoolBundle\Entity\School")
	 * @ORM\JoinColumn(name="school_id", nullable=false)
	 */
	private $school;
	
    /**
    * @ORM\ManyToOne(targetEntity="COM\UserBundle\Entity\User")
    * @ORM\JoinColumn(name="user_id", nullable=false)
    */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
	
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * Set date
     *
     * @param \DateTime $date
     * @return SchoolAdmin
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

    /**
     * Set school
     *
     * @param \COM\SchoolBundle\Entity\School $school
     * @return SchoolAdmin
     */
    public function setSchool(\COM\SchoolBundle\Entity\School $school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return \COM\SchoolBundle\Entity\School 
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set user
     *
     * @param \COM\UserBundle\Entity\User $user
     * @return SchoolAdmin
     */
    public function setUser(\COM\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \COM\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return SchoolAdmin
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
}

<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\FormationRepository")
 */
class Formation
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_formation", type="date")
     */
    private $dateFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_formation", type="string", length=255)
     */
    private $titreFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="description_formation", type="text")
     */
    private $descriptionFormation;

    /**

    * @ORM\ManyToOne(targetEntity="WF\UserBundle\Entity\Freelancer", inversedBy="formations", cascade={"remove"})

    * @ORM\JoinColumn(name="freelancer_id", referencedColumnName="id")

    */

    protected $freelancer;


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
     * Set dateFormation
     *
     * @param \DateTime $dateFormation
     * @return Formation
     */
    public function setDateFormation($dateFormation)
    {
        $this->dateFormation = $dateFormation;

        return $this;
    }

    /**
     * Get dateFormation
     *
     * @return \DateTime 
     */
    public function getDateFormation()
    {
        return $this->dateFormation;
    }

    /**
     * Set titreFormation
     *
     * @param string $titreFormation
     * @return Formation
     */
    public function setTitreFormation($titreFormation)
    {
        $this->titreFormation = $titreFormation;

        return $this;
    }

    /**
     * Get titreFormation
     *
     * @return string 
     */
    public function getTitreFormation()
    {
        return $this->titreFormation;
    }

    /**
     * Set descriptionFormation
     *
     * @param string $descriptionFormation
     * @return Formation
     */
    public function setDescriptionFormation($descriptionFormation)
    {
        $this->descriptionFormation = $descriptionFormation;

        return $this;
    }

    /**
     * Get descriptionFormation
     *
     * @return string 
     */
    public function getDescriptionFormation()
    {
        return $this->descriptionFormation;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->freelancers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add freelancers
     *
     * @param \WF\PlatformBundle\Entity\Freelancer $freelancers
     * @return Formation
     */
    public function setFreelancer($freelancer)
    {
        $this->freelancer = $freelancer;
    }

    /**
     * Get freelancers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFreelancers()
    {
        return $this->freelancers;
    }
}

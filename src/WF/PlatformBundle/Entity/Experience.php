<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\ExperienceRepository")
 */
class Experience
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
     * @ORM\Column(name="date_exp", type="date")
     */
    private $dateExp;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_exp", type="string", length=255)
     */
    private $titreExp;

    /**
     * @var string
     *
     * @ORM\Column(name="description_exp", type="text")
     */
    private $descriptionExp;

    /**

    * @ORM\ManyToOne(targetEntity="WF\UserBundle\Entity\Freelancer", inversedBy="experiences", cascade={"remove"})

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
     * Set dateExp
     *
     * @param \DateTime $dateExp
     * @return Experience
     */
    public function setDateExp($dateExp)
    {
        $this->dateExp = $dateExp;

        return $this;
    }

    /**
     * Get dateExp
     *
     * @return \DateTime 
     */
    public function getDateExp()
    {
        return $this->dateExp;
    }

    /**
     * Set titreExp
     *
     * @param string $titreExp
     * @return Experience
     */
    public function setTitreExp($titreExp)
    {
        $this->titreExp = $titreExp;

        return $this;
    }

    /**
     * Get titreExp
     *
     * @return string 
     */
    public function getTitreExp()
    {
        return $this->titreExp;
    }

    /**
     * Set descriptionExp
     *
     * @param string $descriptionExp
     * @return Experience
     */
    public function setDescriptionExp($descriptionExp)
    {
        $this->descriptionExp = $descriptionExp;

        return $this;
    }

    /**
     * Get descriptionExp
     *
     * @return string 
     */
    public function getDescriptionExp()
    {
        return $this->descriptionExp;
    }

    /**
     * Set freelancer
     *
     * @param \WF\UserBundle\Entity\Freelancer $freelancer
     * @return Experience
     */
    public function setFreelancer(\WF\UserBundle\Entity\Freelancer $freelancer = null)
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * Get freelancer
     *
     * @return \WF\UserBundle\Entity\Freelancer 
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }
}

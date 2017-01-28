<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\OffreRepository")
 */
class Offre
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="budget", type="float")
     */
    private $budget;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depo", type="date")
     */
    private $dateDepo;
    /**

     * @ORM\ManyToOne(targetEntity="WF\UserBundle\Entity\Freelancer", inversedBy="offres", cascade={"remove"})

     * @ORM\JoinColumn(name="freelancer_id", referencedColumnName="id")

    */

    protected $freelancer;

    /**
     * @ORM\ManyToOne(targetEntity="WF\PlatformBundle\Entity\Projet", inversedBy="offres", cascade={"remove"})
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
    */

    protected $projet;




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
     * Set description
     *
     * @param string $description
     * @return Offre
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set budget
     *
     * @param float $budget
     * @return Offre
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return float 
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set dateDepo
     *
     * @param \DateTime $dateDepo
     * @return Offre
     */
    public function setDateDepo($dateDepo)
    {
        $this->dateDepo = $dateDepo;

        return $this;
    }

    /**
     * Get dateDepo
     *
     * @return \DateTime 
     */
    public function getDateDepo()
    {
        return $this->dateDepo;
    }

    /**
     * Set freelancer
     *
     * @param \WF\UserBundle\Entity\Freelancer $freelancer
     * @return Offre
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

    /**
     * Set projet
     *
     * @param \WF\PlatformBundle\Entity\Projet $projet
     * @return Offre
     */
    public function setProjet(\WF\PlatformBundle\Entity\Projet $projet = null)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \WF\PlatformBundle\Entity\Projet 
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Set projet_offre
     *
     * @param \WF\PlatformBundle\Entity\Projet $projetOffre
     * @return Offre
     */
    public function setProjetOffre(\WF\PlatformBundle\Entity\Projet $projetOffre = null)
    {
        $this->projet_offre = $projetOffre;

        return $this;
    }

    /**
     * Get projet_offre
     *
     * @return \WF\PlatformBundle\Entity\Projet 
     */
    public function getProjetOffre()
    {
        return $this->projet_offre;
    }
}

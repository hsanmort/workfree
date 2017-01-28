<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competence
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\CompetenceRepository")
 */
class Competence
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
     * @ORM\Column(name="nom_comp", type="string", length=255)
     */
    private $nomComp;

    /**
     *@ORM\ManyToMany(targetEntity="WF\UserBundle\Entity\Freelancer", mappedBy="competences")
    */

    private $freelancers;


    /**
     *@ORM\ManyToOne(targetEntity="WF\PlatformBundle\Entity\Categorie", inversedBy="competences", cascade={"remove"})
     *ORM\JoinColumn(name="cat_id",referencedColumnName="id")
    */

    protected $categorie;

    


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
     * Set nomComp
     *
     * @param string $nomComp
     * @return Competence
     */
    public function setNomComp($nomComp)
    {
        $this->nomComp = $nomComp;

        return $this;
    }

    /**
     * Get nomComp
     *
     * @return string 
     */
    public function getNomComp()
    {
        return $this->nomComp;
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
     * @param \WF\UserBundle\Entity\Freelancer $freelancers
     * @return Competence
     */
    public function addFreelancer(\WF\UserBundle\Entity\Freelancer $freelancers)
    {
        $this->freelancers[] = $freelancers;

        return $this;
    }

    /**
     * Remove freelancers
     *
     * @param \WF\UserBundle\Entity\Freelancer $freelancers
     */
    public function removeFreelancer(\WF\UserBundle\Entity\Freelancer $freelancers)
    {
        $this->freelancers->removeElement($freelancers);
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

    /**
     * Set categorie
     *
     * @param \WF\UserBundle\Entity\Categorie $categorie
     * @return Competence
     */
    public function setCategorie(\WF\UserBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \WF\UserBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}

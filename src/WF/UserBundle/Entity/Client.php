<?php

namespace WF\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="WF\UserBundle\Entity\ClientRepository")
 */
class Client extends User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="metier", type="string", length=100,nullable=true)
     */
    private $metier;

    /**

    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Projet", mappedBy="client", cascade={"remove", "persist"})

    */

    protected $projets;


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
     * Set metier
     *
     * @param string $metier
     * @return Client
     */
    public function setMetier($metier)
    {
        $this->metier = $metier;

        return $this;
    }

    /**
     * Get metier
     *
     * @return string 
     */
    public function getMetier()
    {
        return $this->metier;
    }

    /**
     * Add projets
     *
     * @param \WF\PlatformBundle\Entity\Projet $projets
     * @return Client
     */
    public function addProjet(\WF\PlatformBundle\Entity\Projet $projets)
    {
        $this->projets[] = $projets;

        return $this;
    }

    /**
     * Remove projets
     *
     * @param \WF\PlatformBundle\Entity\Projet $projets
     */
    public function removeProjet(\WF\PlatformBundle\Entity\Projet $projets)
    {
        $this->projets->removeElement($projets);
    }

    /**
     * Get projets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjets()
    {
        return $this->projets;
    }
      public function __construct()
    {
         parent::__construct();
        
        $this->roles = array('ROLE_CLIENT');

       
    }
}

<?php

namespace WF\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Recruteur
 *
 * @ORM\Table(name="recruteur")
 * @ORM\Entity(repositoryClass="WF\UserBundle\Entity\RecruteurRepository")
 */
class Recruteur extends User
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
     * @ORM\Column(name="nom_soci", type="string", length=100,nullable=true)
     */
    private $nomSoci;


    /**
     * Get id
     *
     * @return integer 
     */

    /**
     * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Test", mappedBy="recruteur", cascade={"persist", "remove", "merge"})
     */
    protected $tests;


    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomSoci
     *
     * @param string $nomSoci
     * @return Recruteur
     */
    public function setNomSoci($nomSoci)
    {
        $this->nomSoci = $nomSoci;

        return $this;
    }

    /**
     * Get nomSoci
     *
     * @return string 
     */
    public function getNomSoci()
    {
        return $this->nomSoci;
    }
     public function __construct() {
         
        parent::__construct();

        $this->roles = array('ROLE_RECRUTEUR');

        $this->tests = new ArrayCollection();
    }
  

    /**
     * Add tests
     *
     * @param \WF\PlatformBundle\Entity\Test $tests
     * @return Recruteur
     */
    public function addTest(\WF\PlatformBundle\Entity\Test $tests)
    {
        $this->tests[] = $tests;

        return $this;
    }

    /**
     * Remove tests
     *
     * @param \WF\PlatformBundle\Entity\Test $tests
     */
    public function removeTest(\WF\PlatformBundle\Entity\Test $tests)
    {
        $this->tests->removeElement($tests);
    }

    /**
     * Get tests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTests()
    {
        return $this->tests;
    }
}

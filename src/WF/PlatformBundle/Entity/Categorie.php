<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="nom_cat", type="string", length=255)
     */
    private $nomCat;

    /**

    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Projet", mappedBy="categorie", cascade={"remove", "persist"})

    */

    protected $projets;


    /**

    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Competence", mappedBy="categorie", cascade={"remove", "persist"})

    */

    protected $competences;


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
     * Set nomCat
     *
     * @param string $nomCat
     * @return Categorie
     */
    public function setNomCat($nomCat)
    {
        $this->nomCat = $nomCat;

        return $this;
    }

    /**
     * Get nomCat
     *
     * @return string 
     */
    public function getNomCat()
    {
        return $this->nomCat;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add projets
     *
     * @param \WF\PlatformBundle\Entity\Projet $projets
     * @return Categorie
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

    /**
     * Add competences
     *
     * @param \WF\PlatformBundle\Entity\Competence $competences
     * @return Categorie
     */
    public function addCompetence(\WF\PlatformBundle\Entity\Competence $competences)
    {
        $this->competences[] = $competences;

        return $this;
    }

    /**
     * Remove competences
     *
     * @param \WF\PlatformBundle\Entity\Competence $competences
     */
    public function removeCompetence(\WF\PlatformBundle\Entity\Competence $competences)
    {
        $this->competences->removeElement($competences);
    }

    /**
     * Get competences
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompetences()
    {
        return $this->competences;
    }
}

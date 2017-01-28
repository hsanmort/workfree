<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\PaiementRepository")
 */
class Paiement
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
     * @var float
     *
     * @ORM\Column(name="Montant", type="float")
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_paie", type="date")
     */
    private $datePaie;

    /**
     * @var integer
     *
     * @ORM\Column(name="mode_paie", type="integer")
     */
    private $modePaie;

    /**
    
    * @ORM\OneToOne(targetEntity="WF\PlatformBundle\Entity\Projet")
    
    * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
    
    */

    private $projet;



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
     * Set montant
     *
     * @param float $montant
     * @return Paiement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set datePaie
     *
     * @param \DateTime $datePaie
     * @return Paiement
     */
    public function setDatePaie($datePaie)
    {
        $this->datePaie = $datePaie;

        return $this;
    }

    /**
     * Get datePaie
     *
     * @return \DateTime 
     */
    public function getDatePaie()
    {
        return $this->datePaie;
    }

    /**
     * Set modePaie
     *
     * @param integer $modePaie
     * @return Paiement
     */
    public function setModePaie($modePaie)
    {
        $this->modePaie = $modePaie;

        return $this;
    }

    /**
     * Get modePaie
     *
     * @return integer 
     */
    public function getModePaie()
    {
        return $this->modePaie;
    }

    /**
     * Set projet
     *
     * @param \WF\PlatformBundle\Entity\Projet $projet
     * @return Paiement
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
}

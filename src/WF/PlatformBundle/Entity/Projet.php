<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Projet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\ProjetRepository")
 */
class Projet
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
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer")
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var float
     *
     * @ORM\Column(name="budget", type="float")
     */
    private $budget;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="avancement", type="text" ,nullable=true)
     */
    private $avancement;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=250,nullable=true)
     */
    protected $photo;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    /**
     * @param UploadedFile $file
     * @return object
     */
    public function setFile(UploadedFile $file = null)
    {
        // set the value of the holder
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->photo)) {
            // store the old name to delete after the update
            $this->t = $this->photo;
            $this->tempPath = null;
        } else {
            $this->photo = 'initial_projet';
        }

        return $this;
    }

    /**
     * Get the file used for profile picture uploads
     * 
     * @return UploadedFile
     */
    public function getFile()
    {

        return $this->file;
    }

    /**
     * @ORM\PrePersist() 
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // a file was uploaded
            // generate a unique filename
            $filename = $this->generateRandomProfilePictureFilename();
            $this->setPhoto($filename . '.' . $this->getFile()->guessExtension());
        }
    }
    /**
     * Generates a 32 char long random filename
     * 
     * @return string
     */
    public function generateRandomProfilePictureFilename()
    {
        $count = 0;
        do {
            $generator = new SecureRandom();
            $random = $generator->nextBytes(16);
            $randomString = bin2hex($random);
            $count++;
        } while (file_exists($this->getUploadRootDir() . '/' . $randomString . '.' . $this->getFile()->guessExtension()) && $count < 50);

        return $randomString;
    }

    /**
     * @ORM\PostPersist() 
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }
        $this->getFile()->move($this->getUploadRootDir(), $this->getPhoto());

        if (isset($this->tempPath) && file_exists($this->getUploadRootDir() . '/' . $this->tempPath)) {
            unlink($this->getUploadRootDir() . '/' . $this->tempPath);
            $this->tempPath = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove() 
     */
    public function removeUpload()
    {
        if ($file == $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->photo ? null : $this->getUploadRootDir() . '/' . $this->photo;
    }

    public function getWebPath()
    {
        return null === $this->photo ? null : $this->getUploadDir() . '/' .
                $this->id . '/' . $this->photo;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir() . '/' . $this->id;
    }

    protected function getUploadDir()
    {
        return 'upload/projet';
    }
    /**
     * @var float
     *
     * @ORM\Column(name="note_client", type="float",nullable=true)
     */
    private $noteClient;

    /**
     * @var float
     *
     * @ORM\Column(name="note_freelancer", type="float",nullable=true)
     */
    private $noteFreelancer;

    /**
    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Offre", mappedBy="projet", cascade={"remove", "persist"})
    */
    protected $offres;

    /**

     * @ORM\ManyToOne(targetEntity="WF\PlatformBundle\Entity\Categorie", inversedBy="projets", cascade={"remove"})

     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")

    */

    protected $categorie;

     /**

     * @ORM\ManyToOne(targetEntity="WF\UserBundle\Entity\Client", inversedBy="projets", cascade={"remove"})

     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")

    */

    protected $client;

    /**
    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Reclamation", mappedBy="projet", cascade={"remove", "persist"})
    */

    protected $reclamations;
    
    /**
     *@ORM\OneToOne(targetEntity="WF\PlatformBundle\Entity\Paiement",mappedBy="projet")
    */

    private $paiement;

    /**
    
    * @ORM\OneToOne(targetEntity="WF\PlatformBundle\Entity\Offre")
    
    * @ORM\JoinColumn(name="offre_id", referencedColumnName="id")
    
    */

    private $offre;


    /**
     * Get id
     *
     * @return integer 
     */
    /**
     *@ORM\Column(name="published",type="boolean")
     */
    private $published =true;
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return Projet
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Projet
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
     * Set duree
     *
     * @param integer $duree
     * @return Projet
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Projet
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set budget
     *
     * @param float $budget
     * @return Projet
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
     * Set etat
     *
     * @param integer $etat
     * @return Projet
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set avancement
     *
     * @param string $avancement
     * @return Projet
     */
    public function setAvancement($avancement)
    {
        $this->avancement = $avancement;

        return $this;
    }

    /**
     * Get avancement
     *
     * @return string 
     */
    public function getAvancement()
    {
        return $this->avancement;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Projet
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set noteClient
     *
     * @param float $noteClient
     * @return Projet
     */
    public function setNoteClient($noteClient)
    {
        $this->noteClient = $noteClient;

        return $this;
    }

    /**
     * Get noteClient
     *
     * @return float 
     */
    public function getNoteClient()
    {
        return $this->noteClient;
    }

    /**
     * Set noteFreelancer
     *
     * @param float $noteFreelancer
     * @return Projet
     */
    public function setNoteFreelancer($noteFreelancer)
    {
        $this->noteFreelancer = $noteFreelancer;

        return $this;
    }

    /**
     * Get noteFreelancer
     *
     * @return float 
     */
    public function getNoteFreelancer()
    {
        return $this->noteFreelancer;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Projet
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offres = new \Doctrine\Common\Collections\ArrayCollection();
        //new added le 08/05/2016 pour ajouter un projet
        $this->dateDebut = new \Datetime();
         //$this->categorie = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Add offres
     *
     * @param \WF\PlatformBundle\Entity\Offre $offres
     * @return Projet
     */
    public function addOffre(\WF\PlatformBundle\Entity\Offre $offres)
    {
        $this->offres[] = $offres;

        return $this;
    }

    /**
     * Remove offres
     *
     * @param \WF\PlatformBundle\Entity\Offre $offres
     */
    public function removeOffre(\WF\PlatformBundle\Entity\Offre $offres)
    {
        $this->offres->removeElement($offres);
    }

    /**
     * Get offres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOffres()
    {
        return $this->offres;
    }

    /**
     * Set categorie
     *
     * @param \WF\PlatformBundle\Entity\Categorie $categorie
     * @return Projet
     */
    public function setCategorie(\WF\PlatformBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \WF\PlatformBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set client
     *
     * @param \WF\UserBundle\Entity\Client $client
     * @return Projet
     */
    public function setClient(\WF\UserBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \WF\UserBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add reclamations
     *
     * @param \WF\PlatformBundle\Entity\Reclamation $reclamations
     * @return Projet
     */
    public function addReclamation(\WF\PlatformBundle\Entity\Reclamation $reclamations)
    {
        $this->reclamations[] = $reclamations;

        return $this;
    }

    /**
     * Remove reclamations
     *
     * @param \WF\PlatformBundle\Entity\Reclamation $reclamations
     */
    public function removeReclamation(\WF\PlatformBundle\Entity\Reclamation $reclamations)
    {
        $this->reclamations->removeElement($reclamations);
    }

    /**
     * Get reclamations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReclamations()
    {
        return $this->reclamations;
    }

    /**
     * Set paiement
     *
     * @param \WF\PlatformBundle\Entity\Paiement $paiement
     * @return Projet
     */
    public function setPaiement(\WF\PlatformBundle\Entity\Paiement $paiement = null)
    {
        $this->paiement = $paiement;

        return $this;
    }

    /**
     * Get paiement
     *
     * @return \WF\PlatformBundle\Entity\Paiement 
     */
    public function getPaiement()
    {
        return $this->paiement;
    }

    /**
     * Set offre
     *
     * @param \WF\PlatformBundle\Entity\Offre $offre
     * @return Projet
     */
    public function setOffre(\WF\PlatformBundle\Entity\Offre $offre = null)
    {
        $this->offre = $offre;

        return $this;
    }

    /**
     * Get offre
     *
     * @return \WF\PlatformBundle\Entity\Offre 
     */
    public function getOffre()
    {
        return $this->offre;
    }
}

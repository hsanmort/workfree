<?php

namespace WF\UserBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorMap({"freelancer" = "Freelancer","client" = "Client","recruteur" = "Recruteur"})
 */
abstract class User extends BaseUser
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
   /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,nullable=true)
     */
  protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=250,nullable=true)
     */
    protected $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naiss", type="date",nullable=true)
     */
    protected $dateNaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255 ,nullable=true)
     */
    protected $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255,nullable=true)
     */
    protected $adresse;

    /*Add new File Test ADD the path */

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;
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
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->t = $this->path;
            $this->tempPath = null;
        } else {
            $this->path = 'initial';
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
            $this->setPath($filename . '.' . $this->getFile()->guessExtension());
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
        $this->getFile()->move($this->getUploadRootDir(), $this->getPath());

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
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' .
                $this->id . '/' . $this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir() . '/' . $this->id;
    }

    protected function getUploadDir()
    {
        return 'upload/users';
    }

       /**
     * Set path
     *
     * @param string $path
     * @return User
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
    /*Fin Ajout*/


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
 

    /**
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaiss
     *
     * @param \DateTime $dateNaiss
     * @return User
     */
    public function setDateNaiss($dateNaiss)
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    /**
     * Get dateNaiss
     *
     * @return \DateTime 
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return User
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
     * Set adresse
     *
     * @param string $adresse
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}

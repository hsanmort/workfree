<?php

namespace WF\UserBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * Freelancer
 *
 * @ORM\Table(name="freelancer")
 * @ORM\Entity(repositoryClass="WF\UserBundle\Entity\FreelancerRepository")
 */
class Freelancer extends User
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
     * @ORM\Column(name="cv", type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text",nullable=true)
     */
    private $resume;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dispo", type="boolean",nullable=true)
     */
    private $dispo;


    
    /**

    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Formation", mappedBy="freelancer", cascade={"remove", "persist"})

    */
    protected $formations;

    /**
     * @ORM\ManyToMany(targetEntity="WF\PlatformBundle\Entity\Competence", inversedBy="freelancers")
     * @ORM\JoinTable(name="FreelancerCompetence")
     */
    private $competences;

    /**

    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Experience", mappedBy="freelancer", cascade={"remove", "persist"})

    */

    protected $experiences;
    
    /**

    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Offre", mappedBy="freelancer", cascade={"remove", "persist"})

    */

    protected $offres;




    /**
     * @Assert\File(maxSize="6000000")
     */
    private $fileCv;



     public function __construct()
    {
         parent::__construct();
        
        $this->roles = array('ROLE_FREELANCER');

       
    }




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
     * Set cv
     *
     * @param string $cv
     * @return Freelancer
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string 
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set resume
     *
     * @param string $resume
     * @return Freelancer
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string 
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set dispo
     *
     * @param boolean $dispo
     * @return Freelancer
     */
    public function setDispo($dispo)
    {
        $this->dispo = $dispo;

        return $this;
    }

    /**
     * Get dispo
     *
     * @return boolean 
     */
    public function getDispo()
    {
        return $this->dispo;
    }

    /**
     * Add tests
     *
     * @param \WF\PlatformBundle\Entity\Test $tests
     * @return Freelancer
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

    /**
     * Add formations
     *
     * @param \WF\PlatformBundle\Entity\Formation $formations
     * @return Freelancer
     */
    public function addFormation(\WF\PlatformBundle\Entity\Formation $formations)
    {
        $this->formations[] = $formations;

        return $this;
    }

    /**
     * Remove formations
     *
     * @param \WF\PlatformBundle\Entity\Formation $formations
     */
    public function removeFormation(\WF\PlatformBundle\Entity\Formation $formations)
    {
        $this->formations->removeElement($formations);
    }

    /**
     * Get formations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormations()
    {
        return $this->formations;
    }

    /**
     * Add competences
     *
     * @param \WF\PlatformBundle\Entity\Competence $competences
     * @return Freelancer
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

    /**
     * Add experiences
     *
     * @param \WF\PlatformBundle\Entity\Experience $experiences
     * @return Freelancer
     */
    public function addExperience(\WF\PlatformBundle\Entity\Experience $experiences)
    {
        $this->experiences[] = $experiences;

        return $this;
    }

    /**
     * Remove experiences
     *
     * @param \WF\PlatformBundle\Entity\Experience $experiences
     */
    public function removeExperience(\WF\PlatformBundle\Entity\Experience $experiences)
    {
        $this->experiences->removeElement($experiences);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * Add offres
     *
     * @param \WF\PlatformBundle\Entity\Offre $offres
     * @return Freelancer
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

    /*************************************************************/



    /**
     * @param UploadedFile $fileCv
     * @return object
     */
    public function setFileCv(UploadedFile $fileCv = null)
    {
        // set the value of the holder
        $this->fileCv = $fileCv;
        // check if we have an old image cv
        if (isset($this->cv)) {
            // store the old name to delete after the update
            $this->t = $this->cv;
            $this->tempcv = null;
        } else {
            $this->cv = 'initial';
        }

        return $this;
    }

    /**
     * Get the fileCv used for profile picture uploads
     * 
     * @return UploadedFile
     */
    public function getFileCv()
    {

        return $this->fileCv;
    }

    /**
     * @ORM\PrePersist() 
     * @ORM\PreUpdate() 
     */
    public function preUploadCv()
    {
        if (null !== $this->getFileCv()) {
            // a file was uploaded
            // generate a unique filename
            $filename = $this->generateRandomProfilePictureFilenameCv();
            $this->setCv($filename . '.' . $this->getFileCv()->guessExtension());
        }
    }

    /**
     * Generates a 32 char long random filename
     * 
     * @return string
     */
    public function generateRandomProfilePictureFilenameCv()
    {
        $count = 0;
        do {
            $generator = new SecureRandom();
            $random = $generator->nextBytes(16);
            $randomString = bin2hex($random);
            $count++;
        } while (file_exists($this->getUploadRootDirCv() . '/' . $randomString . '.' . $this->getFileCv()->guessExtension()) && $count < 50);

        return $randomString;
    }

    /**
     * @ORM\PostPersist() 
     * @ORM\PostUpdate() 
     */
    public function uploadCv()
    {
        if (null === $this->fileCv) {
            return;
        }
        $this->getFileCv()->move($this->getUploadRootDirCv(), $this->getCv());

        if (isset($this->tempcv) && file_exists($this->getUploadRootDirCv() . '/' . $this->tempcv)) {
            unlink($this->getUploadRootDirCv() . '/' . $this->tempcv);
            $this->tempcv = null;
        }
        $this->fileCv = null;
    }

    /**
     * @ORM\PostRemove() 
     */
    public function removeUploadCv()
    {
        if ($fileCv == $this->getAbsoluteCv()) {
            unlink($fileCv);
        }
    }

    public function getAbsolutecv()
    {
        return null === $this->cv ? null : $this->getUploadRootDirCv() . '/' . $this->cv;
    }

    public function getWebCv()
    {
        return null === $this->cv ? null : $this->getUploadDirCv() . '/' .
                $this->id . '/' . $this->cv;
    }

    protected function getUploadRootDirCv()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDirCv() . '/' . $this->id;
    }

    protected function getUploadDirCv()
    {
        return 'upload/cv';
    }




}

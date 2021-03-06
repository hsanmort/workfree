<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\TestRepository")
 */
class Test
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
     * @ORM\Column(name="Nom_test", type="string", length=255)
     */
    private $nomTest;

    /**
     * @var integer
     *
     * @ORM\Column(name="Delai", type="integer")
     */
    private $delai;

    /**
     * @var float
     *
     * @ORM\Column(name="score_min", type="float")
     */
    private $scoreMin;

    /** 
     * @ORM\ManyToOne(targetEntity="WF\UserBundle\Entity\Recruteur", inversedBy="tests")
     * @ORM\JoinColumn(name="recruteur_id", 
     * referencedColumnName="id")
     */
    protected $recruteur;

    /**

    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Question", mappedBy="test", cascade={"remove", "persist"})

    */

    protected $questions;

    /**
     * @var boolean
     *
     * @ORM\Column(name="verified", type="boolean")
     */
    private $verified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime")
     */
    private $dateCreate;



    


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
     * Set nomTest
     *
     * @param string $nomTest
     * @return Test
     */
    public function setNomTest($nomTest)
    {
        $this->nomTest = $nomTest;

        return $this;
    }

    /**
     * Get nomTest
     *
     * @return string 
     */
    public function getNomTest()
    {
        return $this->nomTest;
    }

    /**
     * Set delai
     *
     * @param integer $delai
     * @return Test
     */
    public function setDelai($delai)
    {
        $this->delai = $delai;

        return $this;
    }

    /**
     * Get delai
     *
     * @return integer 
     */
    public function getDelai()
    {
        return $this->delai;
    }

    /**
     * Set scoreMin
     *
     * @param float $scoreMin
     * @return Test
     */
    public function setScoreMin($scoreMin)
    {
        $this->scoreMin = $scoreMin;

        return $this;
    }

    /**
     * Get scoreMin
     *
     * @return float 
     */
    public function getScoreMin()
    {
        return $this->scoreMin;
    }

    /**
     * Set recruteur
     *
     * @param \WF\UserBundle\Entity\Recruteur $recruteur
     * @return Test
     */
    public function setRecruteur(\WF\UserBundle\Entity\Recruteur $recruteur = null)
    {
        $this->recruteur = $recruteur;

        return $this;
    }

    /**
     * Get recruteur
     *
     * @return \WF\UserBundle\Entity\Recruteur 
     */
    public function getRecruteur()
    {
        return $this->recruteur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->freelancers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->verified = 0;
        $this->dateCreate = new \Datetime();
        
    }


    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     * @return Test
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime 
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }




    /**
     * Add freelancers
     *
     * @param \WF\UserBundle\Entity\Freelancer $freelancers
     * @return Test
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
     * Add questions
     *
     * @param \WF\PlatformBundle\Entity\Question $questions
     * @return Test
     */
    public function addQuestion(\WF\PlatformBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \WF\PlatformBundle\Entity\Question $questions
     */
    public function removeQuestion(\WF\PlatformBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }


    /**
     * Set verified
     *
     * @param boolean $verified
     * @return Test
     */
    public function setVerified($verified = 0)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return boolean 
     */
    public function getVerified()
    {
        return $this->verified;
    }


}

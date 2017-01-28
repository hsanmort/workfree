<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\QuestionRepository")
 */
class Question
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
     * @var integer
     *
     * @ORM\Column(name="numero_ques", type="integer")
     */
    private $numeroQues;

    /**
     * @var string
     *
     * @ORM\Column(name="text_ques", type="text")
     */
    private $textQues;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse_ques", type="integer")
     */
    private $reponseQues;

    /**
     *@ORM\ManyToOne(targetEntity="WF\PlatformBundle\Entity\Test", inversedBy="questions", cascade={"remove"})
     *ORM\JoinColumn(name="test_id",referencedColumnName="id")
    */

    protected $test;

    /**

    * @ORM\OneToMany(targetEntity="WF\PlatformBundle\Entity\Proposition", mappedBy="question", cascade={"remove", "persist"})

    */

    protected $propositions;



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
     * Set numeroQues
     *
     * @param integer $numeroQues
     * @return Question
     */
    public function setNumeroQues($numeroQues)
    {
        $this->numeroQues = $numeroQues;

        return $this;
    }

    /**
     * Get numeroQues
     *
     * @return integer 
     */
    public function getNumeroQues()
    {
        return $this->numeroQues;
    }

    /**
     * Set textQues
     *
     * @param string $textQues
     * @return Question
     */
    public function setTextQues($textQues)
    {
        $this->textQues = $textQues;

        return $this;
    }

    /**
     * Get textQues
     *
     * @return string 
     */
    public function getTextQues()
    {
        return $this->textQues;
    }

    /**
     * Set reponseQues
     *
     * @param string $reponseQues
     * @return Question
     */
    public function setReponseQues($reponseQues)
    {
        $this->reponseQues = $reponseQues;

        return $this;
    }

    /**
     * Get reponseQues
     *
     * @return string 
     */
    public function getReponseQues()
    {
        return $this->reponseQues;
    }

    /**
     * Set test
     *
     * @param \WF\PlatformBundle\Entity\Test $test
     * @return Question
     */
    public function setTest(\WF\PlatformBundle\Entity\Test $test = null)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \WF\PlatformBundle\Entity\Test 
     */
    public function getTest()
    {
        return $this->test;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->propositions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add propositions
     *
     * @param \WF\PlatformBundle\Entity\Proposition $propositions
     * @return Question
     */
    public function addProposition(\WF\PlatformBundle\Entity\Proposition $propositions)
    {

        

        
        $propositions->setQuestion($this);
        $this->propositions[] = $propositions;

        return $this;
    }

    /**
     * Remove propositions
     *
     * @param \WF\PlatformBundle\Entity\Proposition $propositions
     */
    public function removeProposition(\WF\PlatformBundle\Entity\Proposition $propositions)
    {
        $this->propositions->removeElement($propositions);
    }

    /**
     * Get propositions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPropositions()
    {
        return $this->propositions;
    }
}

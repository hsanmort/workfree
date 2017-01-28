<?php

namespace WF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\PropositionRepository")
 */
class Proposition
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
     * @ORM\Column(name="numero_propo", type="integer")
     */
    private $numeroPropo;

    /**
     * @var string
     *
     * @ORM\Column(name="description_propo", type="text")
     */
    private $descriptionPropo;

        /**
     *@ORM\ManyToOne(targetEntity="WF\PlatformBundle\Entity\Question", inversedBy="propositions", cascade={"remove"})
     *ORM\JoinColumn(name="ques_id",referencedColumnName="id")
    */

    protected $question;


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
     * Set numeroPropo
     *
     * @param integer $numeroPropo
     * @return Proposition
     */
    public function setNumeroPropo($numeroPropo)
    {
        $this->numeroPropo = $numeroPropo;

        return $this;
    }

    /**
     * Get numeroPropo
     *
     * @return integer 
     */
    public function getNumeroPropo()
    {
        return $this->numeroPropo;
    }

    /**
     * Set descriptionPropo
     *
     * @param string $descriptionPropo
     * @return Proposition
     */
    public function setDescriptionPropo($descriptionPropo)
    {
        $this->descriptionPropo = $descriptionPropo;

        return $this;
    }

    /**
     * Get descriptionPropo
     *
     * @return string 
     */
    public function getDescriptionPropo()
    {
        return $this->descriptionPropo;
    }

    /**
     * Set question
     *
     * @param \WF\PlatformBundle\Entity\Question $question
     * @return Proposition
     */
    public function setQuestion(\WF\PlatformBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \WF\PlatformBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}

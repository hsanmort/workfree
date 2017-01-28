<?php
// src/WF/PlatformBundle/Entity/TestFreelancer.php

namespace WF\PlatformBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WF\PlatformBundle\Entity\TestFreelancerRepository")
 */
class TestFreelancer
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="note", type="integer")
   */
  private $note;

  /**
   * @ORM\Column(name="time", type="integer")
   */
  private $time;

  /**
   * @ORM\ManyToOne(targetEntity="WF\PlatformBundle\Entity\Test")
   * @ORM\JoinColumn(nullable=false)
   */
  private $test;

  /**
   * @ORM\ManyToOne(targetEntity="WF\UserBundle\Entity\Freelancer")
   * @ORM\JoinColumn(nullable=false)
   */
  private $freelancer;
  
  // ... vous pouvez ajouter d'autres attributs bien sûr

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
     * Set note
     *
     * @param integer $note
     * @return TestFreelancer
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return TestFreelancer
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return integer 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set test
     *
     * @param \WF\PlatformBundle\Entity\Test $test
     * @return TestFreelancer
     */
    public function setTest(\WF\PlatformBundle\Entity\Test $test)
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
     * Set freelancer
     *
     * @param \WF\UserBundle\Entity\Freelancer $freelancer
     * @return TestFreelancer
     */
    public function setFreelancer(\WF\UserBundle\Entity\Freelancer $freelancer)
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * Get freelancer
     *
     * @return \WF\UserBundle\Entity\Freelancer 
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }
}

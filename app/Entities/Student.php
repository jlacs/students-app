<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entities\Subject;

/**
 * @ORM\Entity
 * @ORM\Table(name="students")
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected string $lastname;

    /**
     * @ORM\ManyToMany(targetEntity="Subject", inversedBy="students", cascade={"persist"})
     * @ORM\JoinTable(name="students_subjects")
     * @var ArrayCollection|Subject[]
     */
    protected $subjects;

    /**
     * @ORM\ManyToMany(targetEntity="Subject", mappedBy="students", cascade={"persist"})
     * @var ArrayCollection|toSubject[]
     */
    protected $toSubjects;

    /**
     * @param $firstname
     * @param $lastname
     */
    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname  = $lastname;

        $this->subjects = new ArrayCollection;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of firstname
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Set the value of subjects
     */
    public function setSubjects($subjects): self
    {
        $this->subjects = $subjects;

        return $this;
    }

    public function addSubject(Subject $subject)
    {
        if(!$this->subjects->contains($subject)) {
            $subject->setStudent($this);
            $this->subjects->add($subject);
        }
    }
    
    /**
     * Get the value of toSubjects
     */
    public function getToSubjects()
    {
        return $this->toSubjects;
    }

    /**
     * Set the value of toSubject
     */
    public function setToSubjects($toSubject): self
    {
        $this->toSubject = $toSubject;

        return $this;
    }


}
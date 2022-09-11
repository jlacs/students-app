<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entities\Student;

/**
 * @ORM\Entity
 * @ORM\Table(name="subjects")
 */
class Subject
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
    protected string $name;

    /**
     * @ORM\ManyToMany(targetEntity="Student", inversedBy="subjects", cascade={"persist"})
     * @ORM\JoinTable(name="students_subjects")
     * @var ArrayCollection|Student[]
     */
    protected $students;

    /**
     * @ORM\ManyToMany(targetEntity="Student", mappedBy="subjects", cascade={"persist"})
     * @var ArrayCollection|toStudents[]
     */
    protected $toStudents;

    /**
    * @param $firstname
    * @param $lastname
    */
    public function __construct(string $name)
    {
        $this->name = $name;

        $this->students = new ArrayCollection;
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
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of student
     */
    public function setStudent($student): self
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Set the value of toStudents
     */
    public function setToStudents($toStudents): self
    {
        $this->toStudents = $toStudents;

        return $this;
    }

    public function addStudent(Student $student)
    {
        if(!$this->students->contains($student)) {
            $student->setToSubjects($this);
            $this->students->add($student);
        }
    }
}
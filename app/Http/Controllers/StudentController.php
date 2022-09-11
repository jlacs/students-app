<?php

namespace App\Http\Controllers;

use App\Entities\Student;
use App\Entities\Subject;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

class StudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index()
    {
        $arr_students = $this->em->getRepository(Student::class)->findAll();

        $students = array();
        
        foreach($arr_students as $student) {
            $subjects = array();
            foreach($student->getToSubjects() as $subject) {
                $subjects[] = (object) [
                    'id' => $subject->getId(),
                    'name' => $subject->getName()
                ];
            }

            (object) $students[] = (object) [
                'id' => $student->getId(),
                'firstname' => $student->getFirstname(),
                'lastname' => $student->getLastname(),
                'subjects' => $subjects
            ];
        }

        // dd($students);

        return view('students', [
            'students' => $students,
        ]);
    }
}

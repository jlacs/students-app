<?php

use App\Entities\Student;
use App\Entities\Subject;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('students', [StudentController::class, 'index']);

Route::get('new-student', function (\Doctrine\ORM\EntityManagerInterface $em) {
    $student = new Student('Tony', 'Ironman');

    $em->persist($student);
    $em->flush();

    return 'added!';
});

Route::get('add-student', function (\Doctrine\ORM\EntityManagerInterface $em) {
    $student = $em->getRepository(Subject::class)->find(2);

    $student->addStudent(
        new Student('Steve', 'Captain America')
    );

    $em->persist($student);
    $em->flush();

    return 'added!';
});


Route::get('add-subject', function (\Doctrine\ORM\EntityManagerInterface $em) {
    $subject = $em->getRepository(Student::class)->find(1);

    $subject->addSubject(
        new Subject('Calculus')
    );

    $em->persist($subject);
    $em->flush();

    return 'added!';
});

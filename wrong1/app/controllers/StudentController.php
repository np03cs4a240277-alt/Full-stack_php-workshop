<?php

require_once __DIR__ . '/../models/Student.php';

class StudentController
{
    private $student;
    private $blade;

    public function __construct($pdo, $blade)
    {
        $this->student = new Student($pdo);
        $this->blade = $blade;
    }

    // a. Show all students
    public function index()
    {
        $students = $this->student->all();
        echo $this->blade->render('students.index', [
            'students' => $students
        ]);
    }

    // b. Show create form
    public function create()
    {
        echo $this->blade->render('students.create');
    }

    // c. Store new student
    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];

        $this->student->create($name, $email, $course);

        header("Location: index.php?page=students");
        exit;
    }

    // d. Show edit form
    public function edit($id)
    {
        $student = $this->student->find($id);
        echo $this->blade->render('students.edit', [
            'student' => $student
        ]);
    }

    // e. Update student
    public function update($id)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];

        $this->student->update($id, $name, $email, $course);

        header("Location: index.php?page=students");
        exit;
    }

    // f. Delete student
    public function delete($id)
    {
        $this->student->delete($id);

        header("Location: index.php?page=students");
        exit;
    }
}

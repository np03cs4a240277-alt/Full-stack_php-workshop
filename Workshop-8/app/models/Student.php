<?php

class Student
{
    private $pdo;

    // Constructor: runs when object is created
    public function __construct()
    {
        // Get database connection
        $this->pdo = require __DIR__ . '/../../db.php';
    }

    // a. Get all students
    public function all()
    {
        $sql = "SELECT * FROM students";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // b. Get one student by ID
    public function find($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // c. Create a new student
    public function create($name, $email, $course)
    {
        $sql = "INSERT INTO students (name, email, course) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $email, $course]);
    }

    // d. Update an existing student
    public function update($id, $name, $email, $course)
    {
        $sql = "UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $email, $course, $id]);
    }

    // e. Delete a student
    public function delete($id)
    {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}

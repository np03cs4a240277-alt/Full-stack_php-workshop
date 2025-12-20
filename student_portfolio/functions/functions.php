<?php
// Format name: first letter uppercase
function formatName($name) {
    return ucwords(strtolower(trim($name)));
}

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Clean skills string and return array
function cleanSkills($string) {
    $skillsArray = explode(',', $string); // split by comma
    $skillsArray = array_map('trim', $skillsArray); // remove extra spaces
    return $skillsArray;
}

// Save student info to students.txt
function saveStudent($name, $email, $skillsArray) {
    $file = 'data/students.txt';
    $data = [
        'name' => $name,
        'email' => $email,
        'skills' => $skillsArray
    ];
    $line = json_encode($data) . PHP_EOL; // save as JSON string
    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
}

// Upload portfolio file
function uploadPortfolioFile($file) {
    $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== 0) {
        throw new Exception("Error uploading file.");
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedTypes)) {
        throw new Exception("Invalid file type. Only PDF, JPG, PNG allowed.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File size exceeds 2MB limit.");
    }

    $newName = time() . '_' . preg_replace('/[^a-zA-Z0-9_.]/', '', $file['name']);
    $destination = 'uploads/' . $newName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("Failed to move uploaded file.");
    }

    return $destination;
}

<?php

// Function to connect to the database
function connectDatabase() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "dct-ccs-finals";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Validate user credentials
function authenticateUser($email, $password) {
    $conn = connectDatabase();

    $email = $conn->real_escape_string($email);
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Check for duplicate student IDs
function checkStudentExists($student_id) {
    $conn = connectDatabase();
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();

    return $result->num_rows > 0;
}

// Register a new student
function addStudent($student_id, $first_name, $last_name) {
    $conn = connectDatabase();

    $stmt = $conn->prepare("INSERT INTO students (student_id, first_name, last_name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $student_id, $first_name, $last_name);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        $stmt->close();
        $conn->close();
        return false;
    }
}

// Fetch all students
function fetchStudents() {
    $conn = connectDatabase();
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    $students = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
    $conn->close();
    return $students;
}
// Fetch a student by ID
function getStudentById($student_id) {
    $conn = connectDatabase();
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Return student data
    }
    
    $stmt->close();
    $conn->close();
    return null; // Return null if no student found
}

// Update a student by ID
function updateStudent($student_id, $first_name, $last_name) {
    $conn = connectDatabase();
    $stmt = $conn->prepare("UPDATE students SET first_name = ?, last_name = ? WHERE student_id = ?");
    $stmt->bind_param("sss", $first_name, $last_name, $student_id);
    $success = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    return $success;
}

// Function to delete a student by ID
function deleteStudentById($student_id) {
    // Connect to the database
    $conn = connectDatabase();
    
    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);

    // Execute the query
    $result = $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
    // Return true if the delete was successful, false otherwise
    return $result;
}
?>
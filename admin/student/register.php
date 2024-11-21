<?php
session_start();
$pageTitle = "Register Student";
include '../partials/header.php';
include '../../functions.php';

$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Validate fields (check if any field is empty)
    if (empty($student_id) || empty($first_name) || empty($last_name)) {
        $errors[] = 'All fields are required!';
    }

    // Check if student ID already exists
    if (checkStudentExists($student_id)) { // Updated function name
        $errors[] = 'Student ID already exists. Please use a different one.';
    }

    // If no errors, insert the new student into the database
    if (empty($errors)) {
        if (addStudent($student_id, $first_name, $last_name)) { // Updated function name
            $_SESSION['success'] = 'Student registered successfully!';
            header("Location: register.php");
            exit;
        } else {
            $errors[] = 'Failed to register student. Please try again.';
        }
    }
}

// Fetch all students to display in the table
$students = fetchStudents(); // Updated function name

?>

<div class="container-fluid">
    <div class="row">
        <?php include '../partials/side-bar.php'; ?>
        <div class="col-md-9 col-lg-10 mt-5">
            <h2>Register a New Student</h2>
            <br>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register Student</li>
                </ol>
            </nav>
            <hr>
            <br>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>System Errors</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID" required>
                    <br>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
                    <br>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Add Student</button>
            </form>
            <hr>
            <h3 class="mt-5">Student List</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                                <td>
                                    <a href="edit.php?student_id=<?php echo urlencode($student['student_id']); ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="delete.php?student_id=<?php echo urlencode($student['student_id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="attach-subject.php?student_id=<?php echo urlencode($student['student_id']); ?>" class="btn btn-warning btn-sm">Attach Subject</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No students registered yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
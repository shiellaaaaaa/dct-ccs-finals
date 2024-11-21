<?php
session_start();
$pageTitle = "Edit Student";
include '../partials/header.php';
include '../../functions.php';

$errors = [];
$studentToEdit = null;

// Check if 'student_id' is provided in the URL
if (isset($_REQUEST['student_id'])) {
    $student_id = $_REQUEST['student_id'];

    // Fetch student data from the database using the function
    $studentToEdit = getStudentById($student_id);
}

// Handle form submission for updating the student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'])) {
    $updatedData = [
        'student_id' => $_POST['student_id'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name']
    ];

    // Validate inputs
    if (empty($updatedData['first_name'])) {
        $errors[] = "First Name is required";
    }

    if (empty($updatedData['last_name'])) {
        $errors[] = "Last Name is required";
    }

    if (empty($errors)) {
        // Update the student in the database using the function
        if (updateStudent($updatedData['student_id'], $updatedData['first_name'], $updatedData['last_name'])) {
            // Redirect to the register page to see updated student list
            header("Location: register.php");
            exit;
        } else {
            $errors[] = "Failed to update student.";
        }
    }
}
?>

<!-- Main Content Section -->
<div class="container-fluid">
    <div class="row">
        <!-- Include the sidebar -->
        <?php include '../partials/side-bar.php'; ?>
        
        <!-- Main Form Column -->
        <div class="col-md-9 col-lg-10 mt-5">
            <h2>Edit Student</h2>

            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                </ol>
            </nav>
            <br>

            <!-- Error Messages -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <strong>System Errors</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Edit Student Form -->
            <?php if ($studentToEdit): ?>
                <form action="edit.php?student_id=<?= urlencode($studentToEdit['student_id']) ?>" method="post">
                    <div class="form-group">
                        <label for="student_id">Student ID</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" 
                               value="<?= htmlspecialchars($studentToEdit['student_id']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" 
                               value="<?= htmlspecialchars($studentToEdit['first_name']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" 
                               value="<?= htmlspecialchars($studentToEdit['last_name']) ?>">
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                </form>
            <?php else: ?>
                <p class="text-danger">No student record found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include '../partials/footer.php';
?>
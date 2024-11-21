<?php
session_start();
$pageTitle = "Edit Student";
include '../partials/header.php';
include '../../functions.php';


?>

<!-- Main Content Section -->
<div class="container-fluid">
    <div class="row">
        <!-- Include the sidebar -->
        <?php include '../partials/side-bar.php'; ?>
        
        <!-- Main Form Column -->
        <div class="col-md-9 col-lg-10 mt-5">
            <h2>Edit Student</h2>
            <br>
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
            <div class="alert alert-danger">
                <strong>System Errors</strong>
                <ul>
                    <!-- Error messages will go here -->
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Edit Student Form -->
            <form action="edit.php" method="post">
                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text" class="form-control" id="student_id" name="student_id" value="" readonly>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="">
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Update Student</button>
            </form>
        </div>
    </div>
</div>

<?php
include '../partials/footer.php';
?>
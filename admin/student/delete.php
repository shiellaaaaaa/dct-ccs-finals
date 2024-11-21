<?php
session_start();
$pageTitle = "Delete Student Record";
include '../partials/header.php';
include '../../functions.php';
?>
<!-- Main Content Section -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include '../partials/side-bar.php'; ?>

        <!-- Main Content Column -->
        <div class="col-md-9 col-lg-10 mt-5">
            <h2>Delete a Student</h2>
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
                </ol>
            </nav>

            <div class="card mt-3">
                <div class="card-body">
                    <!-- Display message about deleting student -->
                    <h5>Are you sure you want to delete the following student record?</h5>
                    <ul>
                        <li><strong>Student ID:</strong> [Student ID]</li>
                        <li><strong>First Name:</strong> [First Name]</li>
                        <li><strong>Last Name:</strong> [Last Name]</li>
                    </ul>
                    <form method="POST">
                        <input type="hidden" name="student_id" value="[Student ID]">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='register.php';">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Student Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include '../partials/footer.php';
?>
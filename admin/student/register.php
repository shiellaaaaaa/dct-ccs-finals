<?php
session_start();
$pageTitle = "Register Student";
include '../partials/header.php';
include '../../functions.php';

?>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Section -->
        <?php include '../partials/side-bar.php'; ?>
        <!-- Main Content Section -->
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

            <!-- Error Section -->
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>System Errors</strong>
                <ul>
                    <!-- Error messages will go here -->
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Form Section -->
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID" required>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Add Student</button>
            </form>
            <hr>

            <!-- Student List Section -->
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
                    <!-- Student rows will go here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../partials/footer.php';
?>
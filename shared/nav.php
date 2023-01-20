<?php
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location:/hospital/admin/login.php");
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <span class="navbar-brand mb-0">Hospital</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-sort-amount-down "></i>
    </button>
    <?PHP if(isset($_SESSION['admin'])): ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        
            <li class="nav-item active">
                <a class="nav-link" href="/hospital/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Patients
                </a>
                <div class="dropdown-menu">
                    <a href="/hospital/patients/add.php" class="dropdown-item">Add Patients</a>
                    <a href="/hospital/patients/list.php" class="dropdown-item">List Patients</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Doctors
                </a>
                <div class="dropdown-menu">
                <?php if($_SESSION['role'] == 'M'): ?>
                    <a href="/hospital/doctors/add.php" class="dropdown-item">Add Doctors</a>
                <?php endif; ?>
                    <a href="/hospital/doctors/list.php" class="dropdown-item">List Doctors</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Employees
                </a>
                <div class="dropdown-menu">
                <?php if($_SESSION['role'] == 'M'): ?>
                    <a href="/hospital/Employees/add.php" class="dropdown-item">Add Employees</a>
                <?php endif; ?>    
                    <a href="/hospital/Employees/list.php" class="dropdown-item">List Employees</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Departments
                </a>
                <div class="dropdown-menu">
                <?php if($_SESSION['role'] == 'M'): ?>
                    <a href="/hospital/department/add.php" class="dropdown-item">Add Departments</a>
                    <?php endif; ?>
                    <a href="/hospital/department/list.php" class="dropdown-item">List Departments</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Rooms
                </a>
                <div class="dropdown-menu">
                <?php if($_SESSION['role'] == 'M'): ?>
                    <a href="/hospital/rooms/add.php" class="dropdown-item">Add Rooms</a>
                    <?php endif; ?>
                    <a href="/hospital/rooms/list.php" class="dropdown-item">List Rooms</a>
                </div>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <button name="logout" class="btn btn-outline-success my-2 my-sm-0">Logout</button>
        </form>
        <?php else: ?>
        <form class="form-inline my-2 my-lg-0 ml-auto">
            <a href="/hospital/admin/login.php" class="btn btn-outline-success my-2 my-sm-0" type="button">Login</a>
        </form>
        <?php endif; ?>
    </div>
</nav>
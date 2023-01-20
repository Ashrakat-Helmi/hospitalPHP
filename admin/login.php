<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/connection.php';
include '../general/fun.php';

if(isset($_POST['login'])){
    $user = $_POST['name'];
    $pass = $_POST['password'];
    $select = "SELECT * FROM `admin` WHERE user='$user' and pass = $pass";
    $s = mysqli_query($conn, $select);
    $rowNum = mysqli_num_rows($s);
    $row = mysqli_fetch_assoc($s);
    if($rowNum >0){
        $_SESSION['admin'] =$user ;
        $_SESSION['role'] = $row['role'];
      
        header('location:/hospital/index.php');
    }else{
        header('location:/hospital/admin/login.php');
    }
}
// print_r($_SESSION);
?>

<h1 class="display-3 text-center">welcome to Login page</h1>

<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter username......">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="pasword" name="password" class="form-control" placeholder="Enter password......">
                </div>
                <button name="login" class="btn btn-info btn-block">Login</button>
            </form>
        </div>
    </div>
</div>
<?php
include '../shared/scripts.php';
?>
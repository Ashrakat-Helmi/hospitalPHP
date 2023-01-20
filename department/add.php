<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/connection.php';
include '../general/fun.php';
auth();
if ($_SESSION['role'] != 'M') {
    header("location:/hospital/index.php");
}
    
if(isset($_POST['send'])){
    $depName = $_POST['depName'];
    // $depManager = $_POST['depManager'];
    $insert = "INSERT INTO `department` VALUES (NULL , '$depName')";
    $i = mysqli_query($conn, $insert);
    // test($i, 'Inserted');
    header('location:/hospital/department/list.php');
}
$depName = "";
$update = false;
if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `department` WHERE id=$id";
    $ss = mysqli_query($conn, $select);
    $row =mysqli_fetch_assoc($ss);
    $depName = $row['name'];
    if(isset($_POST['update'])){
        $depName = $_POST['depName'];
        $update = "UPDATE `department` SET name='$depName' WHERE id =$id";
        $u = mysqli_query($conn, $update);
        header('location:/hospital/department/list.php');
    }
    
}
?>

<h1 class="display-3 text-center">welcome to Add Departments page</h1>

<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="depName" value="<?php echo  $depName?>" class="form-control" placeholder="Enter new Department ......">
                </div>
                <!-- <div class="form-group">
                    <label>Maneger</label>
                    <input type="text" name="depManager" class="form-control" placeholder="Enter manger name......">
                </div> -->
                <?php if($update): ?>
                <button name="update" class="btn btn-primary btn-block">Update Department</button>
                <?php else: ?>
                <button name="send" class="btn btn-info btn-block">Add Department</button>
                <?php endif; ?>

            </form>
        </div>
    </div>
</div>
<?php
include '../shared/scripts.php';
?>
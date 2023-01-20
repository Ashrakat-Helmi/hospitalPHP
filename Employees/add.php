<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/connection.php';
include '../general/fun.php';
auth();
if ($_SESSION['role'] != 'M') {
    header("location:/hospital/index.php");
}
if (isset($_POST['send'])) {
    $empName = $_POST['empName'];
    $depId = $_POST['depId'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $insert = "INSERT INTO `employees` VALUES (NULL , '$empName',$depId,'$position',$salary)";
    $i = mysqli_query($conn, $insert);
    // test($i, 'Inserted');
    header('location:/hospital/Employees/list.php');
}
$empName = "";
$position = "";
$salary = "";
$update = false;
if (isset($_GET['edit'])) {
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `employees` WHERE id=$id;";
    $ss = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($ss);
    $empName = $row['name'];
    $position = $row['position'];
    $salary = $row['salary'];
    if(isset($_POST['update'])){
        $empName = $_POST['empName'];
        $depId = $_POST['depId'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];
        $update = "UPDATE `employees` SET name='$empName', depId=$depId , position='$position',salary=$salary WHERE id=$id";
        $u = mysqli_query($conn, $update);
        header('location:/hospital/Employees/list.php');
        
    }
}
?>

<h1 class="display-3 text-center">welcome to Add Employees page</h1>

<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" value="<?php echo $empName ?>" name="empName" class="form-control" placeholder="Enter new room number......">
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <?php
                    $select = "SELECT * FROM `department`";
                    $s = mysqli_query($conn, $select);
                    ?>
                    <select name="depId"  class="form-control">
                        <?php foreach ($s as $data) { ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" value="<?php echo $position ?>" name="position" class="form-control" placeholder="Enter new room number......">
                </div>
                <div class="form-group">
                    <label>Salary</label>
                    <input type="text"value="<?php echo $salary ?>" name="salary" class="form-control" placeholder="Enter new room number......">
                </div>

                <?php if($update): ?>
                <button name="update" class="btn btn-primary btn-block">Update Employee</button>
                <?php else: ?>
                <button name="send" class="btn btn-info btn-block">Add Employee</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php
include '../shared/scripts.php';
?>
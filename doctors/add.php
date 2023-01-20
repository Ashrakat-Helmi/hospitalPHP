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
    $name = $_POST['name'];
    $depId = $_POST['depId'];
    $salary = $_POST['salary'];
    $insert = "INSERT INTO `doctors` VALUES (NULL , '$name',$depId,$salary)";
    $i = mysqli_query($conn, $insert);
    // test($i, 'Inserted');
    header('location:/hospital/doctors/list.php');
}

$docName = "";
$salary = "";
$update = false;
if (isset($_GET['edit'])) {
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `doctors` WHERE id=$id;";
    $ss = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($ss);
    $docName = $row['name'];
    $salary = $row['salary'];
    if(isset($_POST['update'])){
        $docName = $_POST['name'];
        $depId = $_POST['depId'];
        $salary = $_POST['salary'];
        $update = "UPDATE `doctors` SET name='$docName', depId=$depId ,salary=$salary WHERE id=$id";
        $u = mysqli_query($conn, $update);
        header('location:/hospital/doctors/list.php');
        
    }
}
?>

<h1 class="display-3 text-center">welcome to Add Doctors page</h1>

<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" value="<?php echo $docName; ?>" name="name" class="form-control" placeholder="Enter new room number......">
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <?php
                    $select = "SELECT * FROM `department`";
                    $s = mysqli_query($conn, $select);
                    ?>
                    <select name="depId" class="form-control">
                        <?php foreach ($s as $data) { ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
               <div class="form-group">
                    <label>Salary</label>
                    <input type="text" value="<?php echo $salary; ?>" name="salary" class="form-control" placeholder="Enter new room number......">
                </div>
                <?php if($update): ?>
                <button name="update" class="btn btn-primary btn-block">Update Doctor</button>
                <?php else: ?>
                <button name="send" class="btn btn-info btn-block">Add Doctor</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php
include '../shared/scripts.php';
?>
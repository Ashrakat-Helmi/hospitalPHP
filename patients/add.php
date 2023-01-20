<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/connection.php';
include '../general/fun.php';
auth();
if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $status = $_POST['status'];
    $docId = $_POST['docId'];
    $roomId = $_POST['roomId'];
    
    $insert = "INSERT INTO `patients` VALUES (NULL , '$name',$age , '$status', $docId , $roomId)";
    $i = mysqli_query($conn, $insert);
    // test($i, 'Inserted');
    header('location:/hospital/patients/list.php');
}

$name = "";
$age = "";
$status = "";
$update = false;
if (isset($_GET['edit'])) {
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `patients` WHERE id=$id;";
    $ss = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($ss);
    $name = $row['name'];
    $age = $row['age'];
    $status = $row['status'];
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $age = $_POST['age'];
        $status = $_POST['status'];
        $docId = $_POST['docId'];
        $roomId = $_POST['roomId'];
        $update = "UPDATE `patients` SET name='$name', age=$age , status='$status',docId=$docId ,roomId=$roomId WHERE id=$id";
        $u = mysqli_query($conn, $update);
        header('location:/hospital/patients/list.php');
        
    }
}
?>

<h1 class="display-3 text-center">welcome to Add Patients page</h1>

<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" value="<?php echo $name; ?>" name="name" class="form-control" placeholder="Enter new room number......">
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="text" value="<?php echo $age; ?>" name="age" class="form-control" placeholder="Enter new room number......">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" value="<?php echo $status; ?>" name="status" class="form-control" placeholder="Enter new room number......">
                </div>

                <div class="form-group">
                    <label>Doctor</label>
                    <?php
                    $select = "SELECT * FROM `doctors`";
                    $s = mysqli_query($conn, $select);
                    ?>
                    <select name="docId" class="form-control">
                        <?php foreach ($s as $data) { ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Room</label>
                    <?php
                    $select = "SELECT * FROM `rooms`";
                    $s = mysqli_query($conn, $select);
                    ?>
                    <select name="roomId" class="form-control">
                        <?php foreach ($s as $data) { ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['roomNum']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php if($update): ?>
                <button name="update" class="btn btn-primary btn-block">Update Patient</button>
                <?php else: ?>
                <button name="send" class="btn btn-info btn-block">Add Patient</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php
include '../shared/scripts.php';
?>
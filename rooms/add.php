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
    $roomNum = $_POST['roomNum'];
    $insert = "INSERT INTO `rooms` VALUES (NULL , '$roomNum')";
    $i = mysqli_query($conn, $insert);
    // test($i, 'Inserted');
    header('location:/hospital/rooms/list.php');
}
$roomNum = "";
$update = false;
if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `rooms` WHERE id=$id";
    $ss = mysqli_query($conn, $select);
    $row =mysqli_fetch_assoc($ss);
    $roomNum = $row['roomNum'];
    if(isset($_POST['update'])){
        $roomNum = $_POST['roomNum'];
        $update = "UPDATE `rooms` SET roomNum=$roomNum WHERE id =$id";
        $u = mysqli_query($conn, $update);
        header('location:/hospital/rooms/list.php');
    }
    
}
?>

<h1 class="display-3 text-center">welcome to Add Rooms page</h1>

<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>Room Number</label>
                    <input type="text" name="roomNum" value="<?php echo $roomNum ?>" class="form-control" placeholder="Enter new room number......">
                </div>
                <?php if($update): ?>
                <button name="update" class="btn btn-primary btn-block">Update Room</button>
                <?php else: ?>
                <button name="send" class="btn btn-info btn-block">Add Room</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php
include '../shared/scripts.php';
?>
<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/connection.php';
include '../general/fun.php';
auth();
$select = "SELECT * FROM `rooms`";
$s = mysqli_query($conn, $select);
// test($s, 'Selected');
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM `rooms` WHERE id=$id";
    $d = mysqli_query($conn, $delete);
    header('location:/hospital/rooms/list.php');
}
?>

<h1 class="display-3 text-center">welcome to List Rooms Page</h1>
<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Number</th>
                    <?php if($_SESSION['role'] == 'M'): ?>
                    <th>Actions</th>
                    <?php endif; ?>
                </tr>
                <?php foreach ($s as $data) { ?>
                <tr>
                    <th><?php echo $data['id']; ?></th>
                    <th><?php echo $data['roomNum']; ?></th>
                    <?php if($_SESSION['role'] == 'M'): ?>
                    <th> <a href="/hospital/rooms/list.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a> </th>
                    <th> <a href="/hospital/rooms/add.php?edit=<?php echo $data['id']; ?>" class="btn btn-primary">Edit</a> </th>
                    <?php endif; ?>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php
include '../shared/scripts.php';
?>
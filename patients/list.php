<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/connection.php';
include '../general/fun.php';
auth();
$select = "SELECT patients.id , patients.name as patName , patients.age,patients.status, doctors.name as docName , rooms.roomNum FROM `patients` JOIN `doctors` on patients.docId = doctors.id join `rooms` ON
patients.roomId = rooms.id;";
$s = mysqli_query($conn, $select);
// test($s, 'Selected');
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM `patients` WHERE id=$id";
    $d = mysqli_query($conn, $delete);
    header('location:/hospital/patients/list.php');
}
?>

<h1 class="display-3 text-center">welcome to List Patients Page</h1>
<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Status</th>
                    <th>Doctor</th>
                    <th>Room</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($s as $data) { ?>
                <tr>
                    <th><?php echo $data['id']; ?></th>
                    <th><?php echo $data['patName']; ?></th>
                    <th><?php echo $data['age']; ?></th>
                    <th><?php echo $data['status']; ?></th>
                    <th><?php echo $data['docName']; ?></th>
                    <th><?php echo $data['roomNum']; ?></th>
                    <th> <a href="/hospital/patients/list.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a> </th>
                    <th> <a href="/hospital/patients/add.php?edit=<?php echo $data['id']; ?>" class="btn btn-primary">Edit</a> </th>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php
include '../shared/scripts.php';
?>
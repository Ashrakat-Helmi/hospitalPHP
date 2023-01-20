<?php
include '../shared/header.php';
include '../shared/nav.php';
include '../general/connection.php';
include '../general/fun.php';
auth();
$select = "SELECT doctors.id, doctors.name as docName ,salary,department.name as depName FROM `doctors` JOIN `department` on
doctors.depId = department.id;";
$s = mysqli_query($conn, $select);
// test($s, 'Selected');
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM `doctors` WHERE id=$id";
    $d = mysqli_query($conn, $delete);
    header('location:/hospital/doctors/list.php');
}
// print_r($_SESSION);
?>

<h1 class="display-3 text-center">welcome to List Doctors Page</h1>
<div class="container col-md-6 mt-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <?php if($_SESSION['role'] == 'M'): ?>
                    <th>Salary</th>
                    <th>Actions</th>
                    <?php endif; ?>
                </tr>
                <?php foreach ($s as $data) { ?>
                <tr>
                    <th><?php echo $data['id']; ?></th>
                    <th><?php echo $data['docName']; ?></th>
                    <th><?php echo $data['depName']; ?></th>
                    <?php if($_SESSION['role'] == 'M'): ?>
                    <th><?php echo $data['salary']; ?></th>
                    <th> <a href="/hospital/doctors/list.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a> </th>
                    <th> <a href="/hospital/doctors/add.php?edit=<?php echo $data['id']; ?>" class="btn btn-primary">Edit</a> </th>
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
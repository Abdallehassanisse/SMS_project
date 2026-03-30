<?php 
include("sidebar.php"); 
include("db.php");
?>
<div class="main">
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>Class List</h2>
            <a href="class_save.php" class="btn btn-primary">Add New Class</a>
        </div>
        <table class="table table-hover table-bordered shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Class Name</th>
                    <th>Department</th>
                    <th>Shift</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT c.id, c.classname, c.shift, d.deptname 
                        FROM classes c 
                        JOIN department d ON c.deptid = d.id";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_assoc($res)){
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['classname']; ?></td>
                    <td><?php echo $row['deptname']; ?></td>
                    <td><?php echo $row['shift']; ?></td>
                    <td>
                        <a href="class_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                        <a href="class_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
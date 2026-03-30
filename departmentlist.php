<?php 
include("db.php"); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Department List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h2>Department List</h2>
        <a href="department_add.php" class="btn btn-primary">Add New Department</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Department Name</th>
                <th>Faculty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Waxaan isku xireynaa labada jadwal (JOIN) si aan u helno magaca Faculty-ga
            $sql = "SELECT d.id, d.deptname, f.name as faculty_name 
                    FROM department d 
                    JOIN faculty f ON d.facultyid = f.id";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_assoc($res)){
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['deptname']; ?></td>
                <td><?php echo $row['faculty_name']; ?></td>
                <td>
                    <a href="department_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                    <a href="department_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ma hubtaa?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
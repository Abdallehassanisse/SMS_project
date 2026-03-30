<?php
include("db.php");

if(isset($_POST['save'])){
    $deptname = $_POST['deptname'];
    $facultyid = $_POST['facultyid'];
    $desc = $_POST['description'];

    $insert = mysqli_query($link, "INSERT INTO department (deptname, facultyid, description) VALUES ('$deptname', '$facultyid', '$desc')");
    if($insert){
        header("location:departmentlist.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-header bg-primary text-white"><h4>Add New Department</h4></div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Department Name:</label>
                    <input type="text" name="deptname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Select Faculty:</label>
                    <select name="facultyid" class="form-control" required>
                        <option value="">-- Choose Faculty --</option>
                        <?php
                        $fac = mysqli_query($link, "SELECT * FROM faculty");
                        while($f = mysqli_fetch_assoc($fac)){
                            echo "<option value='".$f['id']."'>".$f['name']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Description:</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <button type="submit" name="save" class="btn btn-success w-100">Save Department</button>
            </form>
        </div>
    </div>
</body>
</html>
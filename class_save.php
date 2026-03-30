<?php
include("db.php");

if(isset($_POST['save'])){
    $classname = $_POST['classname'];
    $deptid = $_POST['deptid'];
    $shift = $_POST['shift'];

    $insert = mysqli_query($link, "INSERT INTO classes (classname, deptid, shift) VALUES ('$classname', '$deptid', '$shift')");
    if($insert){
        echo "<script>alert('Class saved!'); window.location='class.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-header bg-dark text-white"><h4>Add New Class</h4></div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Class Name:</label>
                    <input type="text" name="classname" class="form-control" placeholder="e.g. CA211" required>
                </div>
                <div class="mb-3">
                    <label>Select Department:</label>
                    <select name="deptid" class="form-select" required>
                        <option value="">-- Choose Dept --</option>
                        <?php
                        $dept_q = mysqli_query($link, "SELECT * FROM department");
                        while($d = mysqli_fetch_assoc($dept_q)){
                            echo "<option value='".$d['id']."'>".$d['deptname']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Shift:</label>
                    <select name="shift" class="form-select" required>
                        <option value="Morning">Morning</option>
                        <option value="Afternoon">Afternoon</option>
                        <option value="Evening">Evening</option>
                    </select>
                </div>
                <button type="submit" name="save" class="btn btn-primary w-100">Save Class</button>
            </form>
        </div>
    </div>
</body>
</html>
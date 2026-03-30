<?php
include("db.php");

// 1. Soo qaado xogta fasalka la rabo in wax laga beddelo
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = mysqli_query($link, "SELECT * FROM classes WHERE id='$id'");
    $row = mysqli_fetch_assoc($select);
    
    if(!$row) { die("Fasalkan laguma helin database-ka."); }
} else {
    die("ID-ga fasalka lama helin.");
}

// 2. Markii batoonka Update la riixo
if(isset($_POST['update'])){
    $classname = $_POST['classname'];
    $deptid = $_POST['deptid'];
    $shift = $_POST['shift'];
    
    $update = mysqli_query($link, "UPDATE classes SET 
                                    classname='$classname', 
                                    deptid='$deptid', 
                                    shift='$shift' 
                                    WHERE id='$id'");
    
    if($update){
        echo "<script>
                alert('Fasalka si guul leh ayaa loo cusboonaysiiyay');
                window.location='class.php';
              </script>";
    } else {
        echo "Cilad: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; padding-top: 50px; }
        .card { border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Edit Class Details</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Class Name:</label>
                            <input type="text" name="classname" class="form-control" 
                                   value="<?php echo htmlspecialchars($row['classname']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Department:</label>
                            <select name="deptid" class="form-select" required>
                                <?php
                                $dept_query = mysqli_query($link, "SELECT * FROM department");
                                while($dept = mysqli_fetch_assoc($dept_query)){
                                    $selected = ($dept['id'] == $row['deptid']) ? "selected" : "";
                                    echo "<option value='".$dept['id']."' $selected>".$dept['deptname']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Shift:</label>
                            <select name="shift" class="form-select" required>
                                <option value="Morning" <?php if($row['shift'] == "Morning") echo "selected"; ?>>Morning</option>
                                <option value="Afternoon" <?php if($row['shift'] == "Afternoon") echo "selected"; ?>>Afternoon</option>
                                <option value="Evening" <?php if($row['shift'] == "Evening") echo "selected"; ?>>Evening</option>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" name="update" class="btn btn-primary">Update Class</button>
                            <a href="class.php" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
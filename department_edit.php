<?php
include("db.php");

// 1. Soo qaado xogta department-ga la rabo in wax laga beddelo
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = mysqli_query($link, "SELECT * FROM department WHERE id='$id'");
    $row = mysqli_fetch_assoc($select);
    
    if(!$row) { die("Xogtan laguma helin database-ka."); }
} else {
    die("ID lama helin.");
}

// 2. Markii batoonka Update la riixo
if(isset($_POST['update'])){
    $deptname = $_POST['deptname'];
    $facultyid = $_POST['facultyid'];
    $description = $_POST['description'];
    
    // Cusboonaysiinta xogta adoo isticmaalaya deptname iyo facultyid
    $update = mysqli_query($link, "UPDATE department SET 
                                    deptname='$deptname', 
                                    facultyid='$facultyid', 
                                    description='$description' 
                                    WHERE id='$id'");
    
    if($update){
        echo "<script>
                alert('Department-ga si guul leh ayaa loo cusboonaysiiyay');
                window.location='departmentlist.php';
              </script>";
    } else {
        echo "Cilad ayaa dhacday: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Department</title>
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
                <div class="card-header bg-success text-white text-center py-3">
                    <h4 class="mb-0">Edit Department Details</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Department Name:</label>
                            <input type="text" name="deptname" class="form-control" 
                                   value="<?php echo htmlspecialchars($row['deptname']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Faculty:</label>
                            <select name="facultyid" class="form-select" required>
                                <?php
                                $fac_query = mysqli_query($link, "SELECT * FROM faculty");
                                while($fac = mysqli_fetch_assoc($fac_query)){
                                    // Haddii uu yahay faculty-gii hore, ha u doorto (Selected)
                                    $selected = ($fac['id'] == $row['facultyid']) ? "selected" : "";
                                    echo "<option value='".$fac['id']."' $selected>".$fac['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description:</label>
                            <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($row['description']); ?></textarea>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" name="update" class="btn btn-success">Update Department</button>
                            <a href="departmentlist.php" class="btn btn-outline-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
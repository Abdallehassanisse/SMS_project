<?php
include("db.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = mysqli_query($link, "SELECT * FROM faculty WHERE id='$id'");
    $row = mysqli_fetch_assoc($select);
    
    if(!$row) { die("Xogtan laguma helin database-ka."); }
} else {
    die("ID lama helin.");
}

if(isset($_POST['update'])){
    $new_name = $_POST['faculty_name'];
    $update = mysqli_query($link, "UPDATE faculty SET name='$new_name' WHERE id='$id'");
    
    if($update){
        echo "<script>
                alert('Si guul leh ayaa loo beddelay');
                window.location='facultylist.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding-top: 50px; }
        .card { border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .btn-update { background-color: #28a745; color: white; width: 50%; }
        .btn-secondary { background-color: ##5C636A; color: white; width: 50%; }
        .btn-update:hover { background-color: #218838; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Faculty</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Faculty Name:</label>
                            <input type="text" name="faculty_name" class="form-control" 
                                   value="<?php echo htmlspecialchars($row['name']); ?>" required>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" name="update" class="btn btn-update">
                                Update Faculty
                            </button>
                            <a href="facultylist.php" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
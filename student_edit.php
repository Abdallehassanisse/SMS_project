<?php
include("db.php");

// 1. Soo qaado xogta ardayga la doortay
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = mysqli_query($link, "SELECT * FROM student WHERE id='$id'");
    $row = mysqli_fetch_assoc($select);
    
    if(!$row) { die("Ardaygan laguma helin database-ka."); }
} else {
    die("ID-ga ardayga lama helin.");
}

// 2. Markii la riixo batoonka Update
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $classid = $_POST['classid'];
    $address = $_POST['address'];
    $fee = $_POST['tution_fee'];

    $update = mysqli_query($link, "UPDATE student SET 
                                    name='$name', 
                                    phone='$phone', 
                                    gender='$gender', 
                                    classid='$classid', 
                                    address='$address', 
                                    tution_fee='$fee' 
                                    WHERE id='$id'");
    
    if($update){
        echo "<script>
                alert('Xogta ardayga si guul leh ayaa loo cusboonaysiiyay');
                window.location='student.php';
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
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding-top: 50px; }
        .card { border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: none; }
        .card-header { border-radius: 15px 15px 0 0 !important; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0 text-center">Edit Student Information</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Full Name:</label>
                                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Phone Number:</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Gender:</label>
                                <select name="gender" class="form-select" required>
                                    <option value="Male" <?php if($row['gender'] == "Male") echo "selected"; ?>>Male</option>
                                    <option value="Female" <?php if($row['gender'] == "Female") echo "selected"; ?>>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Class:</label>
                                <select name="classid" class="form-select" required>
                                    <?php
                                    $class_q = mysqli_query($link, "SELECT * FROM classes");
                                    while($c = mysqli_fetch_assoc($class_q)){
                                        $sel = ($c['id'] == $row['classid']) ? "selected" : "";
                                        echo "<option value='".$c['id']."' $sel>".$c['classname']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Address:</label>
                                <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($row['address']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tuition Fee ($):</label>
                                <input type="number" name="tution_fee" class="form-control" step="0.01" value="<?php echo $row['tution_fee']; ?>" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="update" class="btn btn-success btn-lg">Update Student</button>
                            <a href="student.php" class="btn btn-outline-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
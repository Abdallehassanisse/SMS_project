<?php
include("db.php");

// 1. Markii la riixo batoonka Save Student
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $classid = $_POST['classid'];
    $address = $_POST['address'];
    $fee = $_POST['tution_fee'];

    $sql = "INSERT INTO student (name, phone, gender, classid, address, tution_fee) 
            VALUES ('$name', '$phone', '$gender', '$classid', '$address', '$fee')";
    
    $insert = mysqli_query($link, $sql);
    
    if($insert){
        echo "<script>alert('Ardayga si guul leh ayaa loo diiwaangeliyay'); window.location='student_list.php';</script>";
    } else {
        echo "Cilad: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container">
    <div class="card mx-auto shadow" style="max-width: 700px;">
        <div class="card-header bg-primary text-white text-center">
            <h3>Add New Student</h3>
        </div>
        <div class="card-body p-4">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Full Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Phone Number:</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Gender:</label>
                        <select name="gender" class="form-select" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Assign Class:</label>
                        <select name="classid" class="form-select" required>
                            <option value="">-- Select Class --</option>
                            <?php
                            // Soo qaado fasallada jira si ardayga loogu xiro
                            $class_q = mysqli_query($link, "SELECT * FROM classes");
                            while($c = mysqli_fetch_assoc($class_q)){
                                echo "<option value='".$c['id']."'>".$c['classname']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Address:</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tuition Fee ($):</label>
                        <input type="number" name="tution_fee" class="form-control" step="0.01" required>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <button type="submit" name="save" class="btn btn-primary btn-lg">Save Student</button>
                    <a href="student_list.php" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
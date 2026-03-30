<?php
include("db.php");
include("sidebar.php");

// 1. Soo saar xogta hadda jirta ee maadada la rabo in la beddelo
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);
    // SQL query si loo helo xogta maadada gaarka ah
    $res = mysqli_query($link, "SELECT * FROM courses WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
}

// 2. Markii la riixo batoonka Update Course
if(isset($_POST['update_course'])){
    $code          = mysqli_real_escape_string($link, $_POST['code']);
    $course_title  = mysqli_real_escape_string($link, $_POST['course_title']);
    $credit        = mysqli_real_escape_string($link, $_POST['credit']);
    $departmentid  = mysqli_real_escape_string($link, $_POST['departmentid']);

    // SQL UPDATE query
    $update_sql = "UPDATE courses SET 
                   code='$code', 
                   course_title='$course_title', 
                   credit='$credit', 
                   departmentid='$departmentid' 
                   WHERE id='$id'";

    if(mysqli_query($link, $update_sql)){
        echo "<script>
                alert('Xogta maadada si guul leh ayaa loo cusuboneysiiyay!');
                window.location='courses.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Cilad: " . mysqli_error($link) . "</div>";
    }
}
?>

<div class="main" style="margin-left: 260px; padding: 40px; background: #f8f9fc; min-height: 100vh;">
    <div class="container">
        <div class="card shadow-sm border-0" style="border-radius: 15px; max-width: 700px; margin: auto;">
            <div class="card-header bg-success text-white py-3" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Wax ka beddel Maaddada: <?php echo htmlspecialchars($row['course_title']); ?></h5>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Code-ka Maadada:</label>
                            <input type="text" name="code" class="form-control" value="<?php echo htmlspecialchars($row['code']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Credit Hours:</label>
                            <input type="number" step="0.1" name="credit" class="form-control" value="<?php echo $row['credit']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Magaca Maadada (Course Title):</label>
                        <input type="text" name="course_title" class="form-control" value="<?php echo htmlspecialchars($row['course_title']); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Waaxda ay ka tirsan tahay (Department):</label>
                        <select name="departmentid" class="form-select" required>
                            <?php
                            // Soo saar dhamaan waaxyaha
                            $depts = mysqli_query($link, "SELECT id, deptname FROM department");
                            while($d = mysqli_fetch_assoc($depts)){
                                // Calaamadee waaxda ay hadda maadadu ka tirsan tahay
                                $selected = ($d['id'] == $row['departmentid']) ? "selected" : "";
                                echo "<option value='".$d['id']."' $selected>".$d['deptname']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="update_course" class="btn btn-success px-5 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i> Save Changes
                        </button>
                        <a href="courses.php" class="btn btn-outline-secondary px-4 py-2 rounded-pill">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
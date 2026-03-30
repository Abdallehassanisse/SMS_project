<?php
include("db.php");
include("sidebar.php");

// 1. Soo saar xogta xaadirinta ee la rabo in la beddelo
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);
    // SQL query si loo helo xogta xaadirinta iyo magaca ardayga
    $sql = "SELECT a.*, s.name FROM attendance a 
            JOIN student s ON a.studentid = s.id 
            WHERE a.id='$id'";
    $res = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($res);
}

// 2. Markii la riixo batoonka Update
if(isset($_POST['update_attendance'])){
    $status          = mysqli_real_escape_string($link, $_POST['status']);
    $attendance_date = mysqli_real_escape_string($link, $_POST['attendance_date']);
    $codeid          = mysqli_real_escape_string($link, $_POST['codeid']);

    // UPDATE query
    $update_sql = "UPDATE attendance SET 
                   status='$status', 
                   attendance_date='$attendance_date', 
                   codeid='$codeid' 
                   WHERE id='$id'";

    if(mysqli_query($link, $update_sql)){
        echo "<script>
                alert('Xaadirinta si guul leh ayaa loo beddelay!');
                window.location='attendance.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Cilad: " . mysqli_error($link) . "</div>";
    }
}
?>

<div class="main" style="margin-left: 260px; padding: 40px; background: #f8f9fc; min-height: 100vh;">
    <div class="container">
        <div class="card shadow-sm border-0" style="border-radius: 15px; max-width: 600px; margin: auto;">
            <div class="card-header bg-success text-white py-3" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i> Wax ka beddel Xaadirinta: <?php echo htmlspecialchars($row['name']); ?></h5>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Maadada (Course):</label>
                        <select name="codeid" class="form-select" required>
                            <?php
                            $courses = mysqli_query($link, "SELECT id, course_title FROM courses");
                            while($c = mysqli_fetch_assoc($courses)){
                                $selected = ($c['id'] == $row['codeid']) ? "selected" : "";
                                echo "<option value='".$c['id']."' $selected>".$c['course_title']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Taariikhda:</label>
                        <input type="date" name="attendance_date" class="form-control" value="<?php echo $row['attendance_date']; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold d-block">Status-ka Ardayga:</label>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="radio" name="status" id="p" value="Present" <?php if($row['status'] == 'Present') echo 'checked'; ?>>
                            <label class="form-check-label text-success fw-bold" for="p">Present</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="a" value="Absent" <?php if($row['status'] == 'Absent') echo 'checked'; ?>>
                            <label class="form-check-label text-danger fw-bold" for="a">Absent</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="update_attendance" class="btn btn-success px-4 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i> Save Changes
                        </button>
                        <a href="attendance.php" class="btn btn-outline-secondary px-4 py-2 rounded-pill">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
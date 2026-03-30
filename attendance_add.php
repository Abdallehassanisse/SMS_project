<?php
include("db.php");
include("sidebar.php");

// 1. Markii la riixo batoonka Save Attendance
if(isset($_POST['save_attendance'])){
    $attendance_date = mysqli_real_escape_string($link, $_POST['attendance_date']); //
    $codeid          = mysqli_real_escape_string($link, $_POST['codeid']);          //
    
    // Waxaan dhex wareegaynaa dhamaan ardayda la soo diray xogtooda
    foreach($_POST['status'] as $studentid => $status_value){
        $studentid = mysqli_real_escape_string($link, $studentid);
        $status    = mysqli_real_escape_string($link, $status_value);

        $sql = "INSERT INTO attendance (studentid, codeid, attendance_date, status) 
                VALUES ('$studentid', '$codeid', '$attendance_date', '$status')";
        mysqli_query($link, $sql);
    }

    echo "<script>
            alert('Xaadirinta si guul leh ayaa loo kaydiyay!');
            window.location='attendance.php';
          </script>";
}
?>

<div class="main" style="margin-left: 260px; padding: 30px; background: #f8f9fa; min-height: 100vh;">
    <div class="container-fluid">
        <div class="card shadow-sm border-0" style="border-radius: 15px;">
            <div class="card-header bg-primary text-white py-3" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i> Diwaangeli Xaadirinta Maanta</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Dooro Maadada (Course):</label>
                            <select name="codeid" class="form-select" required>
                                <option value="">-- Dooro Maadada --</option>
                                <?php
                                $courses = mysqli_query($link, "SELECT id, course_title FROM courses");
                                while($c = mysqli_fetch_assoc($courses)){
                                    echo "<option value='".$c['id']."'>".$c['course_title']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Taariikhda Xaadirinta:</label>
                            <input type="date" name="attendance_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="100">ID</th>
                                    <th>Magaca Ardayga</th>
                                    <th class="text-center">Present</th>
                                    <th class="text-center">Absent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $students = mysqli_query($link, "SELECT id, name FROM student ORDER BY name ASC");
                                while($s = mysqli_fetch_assoc($students)){
                                ?>
                                <tr>
                                    <td>#<?php echo $s['id']; ?></td>
                                    <td class="fw-bold"><?php echo $s['name']; ?></td>
                                    <td class="text-center">
                                        <input type="radio" name="status[<?php echo $s['id']; ?>]" value="Present" checked>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="status[<?php echo $s['id']; ?>]" value="Absent">
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="save_attendance" class="btn btn-primary btn-lg rounded-pill shadow">
                            <i class="fas fa-save me-2"></i> Save Daily Attendance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
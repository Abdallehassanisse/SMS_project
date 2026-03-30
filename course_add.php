<?php
include("db.php");
include("sidebar.php");

// 1. Markii la riixo batoonka Save Course
if(isset($_POST['save_course'])){
    $code          = mysqli_real_escape_string($link, $_POST['code']);
    $course_title  = mysqli_real_escape_string($link, $_POST['course_title']);
    $credit        = mysqli_real_escape_string($link, $_POST['credit']);
    $departmentid  = mysqli_real_escape_string($link, $_POST['departmentid']);

    // SQL si loogu daro jadwalka courses
    $sql = "INSERT INTO courses (code, course_title, credit, departmentid) 
            VALUES ('$code', '$course_title', '$credit', '$departmentid')";

    if(mysqli_query($link, $sql)){
        echo "<script>
                alert('Maadada si guul leh ayaa loogu daray!');
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
            <div class="card-header bg-primary text-white py-3" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0"><i class="fas fa-book-open me-2"></i> Kudar Maaddo Cusub (Add Course)</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Code-ka Maadada:</label>
                            <input type="text" name="code" class="form-control" placeholder="Tusaale: CS101" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Credit Hours:</label>
                            <input type="number" step="0.1" name="credit" class="form-control" placeholder="Tusaale: 3.0" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Magaca Maadada (Course Title):</label>
                        <input type="text" name="course_title" class="form-control" placeholder="Tusaale: Web Development" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Waaxda ay ka tirsan tahay (Department):</label>
                        <select name="departmentid" class="form-select" required>
                            <option value="">-- Dooro Waaxda --</option>
                            <?php
                            // Soo saar waaxyaha ka jira jadwalka department
                            $depts = mysqli_query($link, "SELECT id, deptname FROM department");
                            while($d = mysqli_fetch_assoc($depts)){
                                echo "<option value='".$d['id']."'>".$d['deptname']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="save_course" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i> Save Course
                        </button>
                        <a href="courses.php" class="btn btn-outline-secondary px-4 py-2 rounded-pill">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
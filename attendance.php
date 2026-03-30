<?php 
include("sidebar.php"); 
include("db.php");

// 1. Qabo taariikhda URL-ka ka timid, haddii kalena isticmaal maanta
$selected_date = isset($_GET['view_date']) ? $_GET['view_date'] : date('Y-m-d');

// 2. Query-ga xogta ee taariikhda la doortay
$sql = "SELECT a.*, s.name as s_name, c.course_title 
        FROM attendance a
        JOIN student s ON a.studentid = s.id
        JOIN courses c ON a.codeid = c.id
        WHERE a.attendance_date = '$selected_date' 
        ORDER BY a.id DESC";

$res = mysqli_query($link, $sql);

// 3. Tirinta inta Present iyo Absent ah (Summary)
$count_sql = "SELECT 
                SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) as total_present,
                SUM(CASE WHEN status = 'Absent' THEN 1 ELSE 0 END) as total_absent
              FROM attendance WHERE attendance_date = '$selected_date'";
$count_res = mysqli_query($link, $count_sql);
$counts = mysqli_fetch_assoc($count_res);
?>

<div class="main" style="margin-left: 260px; background: #f8f9fa; min-height: 100vh; padding: 30px;">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark">Xaadirinta Ardayda</h2>
                <p class="text-muted">Eeg xogta: <span class="badge bg-primary"><?php echo date('d M, Y', strtotime($selected_date)); ?></span></p>
                
                <form method="GET" class="d-flex gap-2 align-items-center mt-3">
                    <input type="date" name="view_date" class="form-control" 
                           value="<?php echo $selected_date; ?>" style="width: 200px;">
                    <button type="submit" class="btn btn-dark shadow-sm">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="attendance.php" class="btn btn-outline-secondary">
                        <i class="fas fa-sync"></i> Maanta
                    </a>
                </form>
            </div>
            <a href="attendance_add.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Take Attendance
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-3 bg-white" style="border-left: 5px solid #28a745; border-radius: 10px;">
                    <small class="text-muted fw-bold">PRESENT</small>
                    <h3 class="fw-bold text-success"><?php echo $counts['total_present'] ?? 0; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-3 bg-white" style="border-left: 5px solid #dc3545; border-radius: 10px;">
                    <small class="text-muted fw-bold">ABSENT</small>
                    <h3 class="fw-bold text-danger"><?php echo $counts['total_absent'] ?? 0; ?></h3>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary text-uppercase" style="font-size: 11px;">
                            <tr>
                                <th class="ps-4 py-3">Student Name</th>
                                <th>Course/Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(mysqli_num_rows($res) > 0) {
                                while($row = mysqli_fetch_assoc($res)){ 
                            ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px;">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                        <div class="fw-bold"><?php echo htmlspecialchars($row['s_name']); ?></div>
                                    </div>
                                </td>
                                <td><?php echo $row['course_title']; ?></td>
                                <td>
                                    <div class="text-muted small">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <?php echo date('d M, Y', strtotime($row['attendance_date'])); ?>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                    if($row['status'] == 'Present') {
                                        echo '<span class="badge rounded-pill bg-success-soft text-success px-3" style="background: #e1f6ed;">Present</span>';
                                    } else {
                                        echo '<span class="badge rounded-pill bg-danger-soft text-danger px-3" style="background: #fbe9eb;">Absent</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="attendance_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm px-3 shadow-sm">
                                            <i class="fas fa-edit"></i>Edit
                                        </a>
                                        <a href="attendance_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm px-3 shadow-sm" onclick="return confirm('Ma hubtaa?')">
                                            <i class="fas fa-trash-alt"></i>Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                } 
                            } else {
                                echo '<tr><td colspan="5" class="text-center py-5 text-muted">Ma jiro wax diwaangelin ah oo la helay taariikhdan.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
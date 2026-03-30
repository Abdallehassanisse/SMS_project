<?php 
include("sidebar.php"); 
include("db.php");

// Soo saar tirada guud ee maadooyinka
$count_res = mysqli_query($link, "SELECT COUNT(id) as total_courses FROM courses");
$count_data = mysqli_fetch_assoc($count_res);
$total_courses = $count_data['total_courses'] ?? 0;
?>

<div class="main" style="margin-left: 260px; background: #f8f9fa; min-height: 100vh; padding: 30px;">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark">Maareynta Maadooyinka</h2>
                <p class="text-muted">Liiska maadooyinka iyo waaxyaha ay ka tirsan yihiin</p>
            </div>
            <a href="course_add.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Add New Course
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3" style="background: linear-gradient(45deg, #4e73df, #224abe); color: white; border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle me-3">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                        <div>
                            <small class="opacity-75">Total Courses</small>
                            <h3 class="fw-bold mb-0"><?php echo $total_courses; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary text-uppercase" style="font-size: 11px; letter-spacing: 1px;">
                            <tr>
                                <th class="ps-4 py-3">Code</th>
                                <th>Course Title</th>
                                <th>Credit Hours</th>
                                <th>Department</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Isku xirka jadwalka courses iyo department
                            $sql = "SELECT c.*, d.deptname 
                                    FROM courses c
                                    JOIN department d ON c.departmentid = d.id
                                    ORDER BY c.id DESC";
                            $res = mysqli_query($link, $sql);
                            
                            while($row = mysqli_fetch_assoc($res)){
                            ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                        <?php echo htmlspecialchars($row['code']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo htmlspecialchars($row['course_title']); ?></div>
                                </td>
                                <td>
                                    <span class="fw-bold text-secondary"><?php echo $row['credit']; ?> Credits</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-building text-muted me-2"></i>
                                        <?php echo $row['deptname']; ?>
                                    </div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="course_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm px-3" style="border-radius: 4px;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="course_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm px-3" style="border-radius: 4px;" onclick="return confirm('Ma hubtaa inaad tirtirto maadadan?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
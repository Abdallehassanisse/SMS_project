<?php 
include("sidebar.php"); 
include("db.php");

// 1. Tirakoobka Ardayda
$count_res = mysqli_query($link, "SELECT COUNT(id) as total FROM student");
$count_data = mysqli_fetch_assoc($count_res);
$total_students = $count_data['total'] ?? 0;

$male_res = mysqli_query($link, "SELECT COUNT(id) as total FROM student WHERE gender='Male'");
$male_students = mysqli_fetch_assoc($male_res)['total'] ?? 0;

$female_res = mysqli_query($link, "SELECT COUNT(id) as total FROM student WHERE gender='Female'");
$female_students = mysqli_fetch_assoc($female_res)['total'] ?? 0;
?>

<div class="main" style="margin-left: 260px; background: #f8f9fa; min-height: 100vh; padding: 30px;">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark">Maareynta Ardayda</h2>
                <p class="text-muted">Liiska guud ee ardayda ka diwaangashan nidaamka</p>
            </div>
            <a href="student_add.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-user-plus me-2"></i> Kudar Arday Cusub
            </a>
        </div>

        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3" style="background: linear-gradient(45deg, #4e73df, #224abe); color: white; border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle me-3">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div>
                            <small class="opacity-75">Total Students</small>
                            <h3 class="fw-bold mb-0"><?php echo $total_students; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3" style="background: linear-gradient(45deg, #1cc88a, #13855c); color: white; border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle me-3">
                            <i class="fas fa-mars fa-2x"></i>
                        </div>
                        <div>
                            <small class="opacity-75">Male Students</small>
                            <h3 class="fw-bold mb-0"><?php echo $male_students; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3" style="background: linear-gradient(45deg, #f6c23e, #dda20a); color: white; border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle me-3">
                            <i class="fas fa-venus fa-2x"></i>
                        </div>
                        <div>
                            <small class="opacity-75">Female Students</small>
                            <h3 class="fw-bold mb-0"><?php echo $female_students; ?></h3>
                        </div>
                    </div>
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
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Class</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query isku xiraya student iyo classes
                            $sql = "SELECT s.*, c.classname FROM student s 
                                    JOIN classes c ON s.classid = c.id 
                                    ORDER BY s.id DESC";
                            $res = mysqli_query($link, $sql);
                            while($row = mysqli_fetch_assoc($res)){
                            ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($row['name']); ?></div>
                                    </div>
                                </td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><i class="fas fa-phone-alt me-2 text-muted small"></i><?php echo $row['phone']; ?></td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary px-3"><?php echo $row['classname']; ?></span></td>
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="student_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm px-3" style="border-radius: 4px;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="student_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm px-3" style="border-radius: 4px;" onclick="return confirm('Ma hubtaa inaad tirtirto ardaygan?')">
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
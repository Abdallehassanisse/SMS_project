<?php 
include("db.php");
include("sidebar.php");

// 1. In la tirtiro User
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($link, "DELETE FROM users WHERE id=$id");
    header("location: user.php");
}

// 2. Soo saar dhamaan Users-ka (Sida ku cad sawirkaaga)
$users = mysqli_query($link, "SELECT * FROM users ORDER BY id DESC");
?>

<div class="main" style="margin-left: 260px; background: #f4f7fe; min-height: 100vh; padding: 40px;">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold text-dark">Maamulka Users-ka</h2>
                <p class="text-muted">Liiska isticmaaleyaasha nidaamka SMS.</p>
            </div>
            <a href="user_add.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-user-plus me-2"></i> Kudar User Cusub
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="ps-4 py-3 border-0">ID</th>
                                <th class="border-0">EMAIL</th>
                                <th class="border-0">STATUS</th>
                                <th class="border-0 text-end pe-4">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($u = mysqli_fetch_assoc($users)){ ?>
                            <tr>
                                <td class="ps-4 py-3 fw-bold">#<?php echo $u['id']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                            <i class="fas fa-envelope small"></i>
                                        </div>
                                        <span class="fw-bold"><?php echo $u['email']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                    $status = $u['user_status'];
                                    $class = ($status == 'Active') ? 'bg-success' : 'bg-warning';
                                    ?>
                                    <span class="badge <?php echo $class; ?> rounded-pill px-3">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="user_edit.php?id=<?php echo $u['id']; ?>" class="btn btn-sm btn-light rounded-pill me-2">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                    <a href="user.php?delete=<?php echo $u['id']; ?>" class="btn btn-sm btn-light rounded-pill" onclick="return confirm('Ma hubtaa?')">
                                        <i class="fas fa-trash text-danger"></i>
                                    </a>
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
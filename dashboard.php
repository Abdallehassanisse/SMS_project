<?php
session_start();
// Haddii qofku aanu soo marin login, dib ugu celi login.php
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}
?>





<?php 
include("db.php");
include("sidebar.php");

// 1. Soo saarista xogta tirakoobka
$total_students = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as total FROM student"))['total'];
$total_courses  = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as total FROM courses"))['total'];
$total_revenue  = mysqli_fetch_assoc(mysqli_query($link, "SELECT SUM(amount) as total FROM payment"))['total'] ?? 0;
$today_present  = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as total FROM attendance WHERE attendance_date = CURDATE() AND status='Present'"))['total'];
?>

<style>
    /* Qurxinta guud iyo Saamaynta (Hover Effects) */
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 20px;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .quick-link-btn {
        transition: all 0.2s ease;
        border: 1px solid transparent !important;
    }
    .quick-link-btn:hover {
        background-color: #fff !important;
        border-color: #0d6efd !important;
        transform: translateX(5px);
    }
    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .table thead th {
        background-color: #f8f9fa;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        color: #6c757d;
        border: none;
    }
</style>

<div class="main" style="margin-left: 260px; background: #f4f7fe; min-height: 100vh; padding: 40px;">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold text-dark mb-1">Dashboard-ka Guud</h2>
                <p class="text-muted mb-0">Maamul xogta dugsiga si hufan oo casri ah.</p>
            </div>
            <div class="text-end">
                <span class="badge bg-white text-dark shadow-sm p-2 px-3 rounded-pill" style="border: 1px solid #eee;">
                    <i class="far fa-calendar-alt me-2 text-primary"></i> <?php echo date('D, d M Y'); ?>
                </span>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4 stat-card bg-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                            <i class="fas fa-user-graduate fa-lg"></i>
                        </div>
                        <div>
                            <small class="text-muted fw-bold d-block mb-1">ARDAYDA</small>
                            <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_students); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4 stat-card bg-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-book fa-lg"></i>
                        </div>
                        <div>
                            <small class="text-muted fw-bold d-block mb-1">COURSES</small>
                            <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_courses); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4 stat-card bg-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-info bg-opacity-10 text-info me-3">
                            <i class="fas fa-dollar-sign fa-lg"></i>
                        </div>
                        <div>
                            <small class="text-muted fw-bold d-block mb-1">DAKHLIGA</small>
                            <h3 class="fw-bold mb-0 text-dark">$<?php echo number_format($total_revenue, 1); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4 stat-card bg-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-warning bg-opacity-10 text-warning me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <small class="text-muted fw-bold d-block mb-1">XAADIRKA</small>
                            <h3 class="fw-bold mb-0 text-dark"><?php echo $today_present; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="card-header bg-white py-4 border-0 d-flex justify-content-between align-items-center">
                        <h5 class="m-0 fw-bold text-dark">Dhaqdhaqaaqa Lacagta</h5>
                        <a href="payment.php" class="btn btn-sm btn-light rounded-pill px-3">Eeg Dhamaan</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4 py-3">Ardayga</th>
                                        <th>Lacagta</th>
                                        <th class="text-end pe-4">Taariikhda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $recent_p = mysqli_query($link, "SELECT p.*, s.name FROM payment p JOIN student s ON p.studentid = s.id ORDER BY p.id DESC LIMIT 5");
                                    while($rp = mysqli_fetch_assoc($recent_p)){
                                    ?>
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 12px; font-weight: bold; color: #4e73df;">
                                                    <?php echo strtoupper(substr($rp['name'], 0, 1)); ?>
                                                </div>
                                                <span class="text-dark fw-bold"><?php echo $rp['name']; ?></span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success">+$<?php echo number_format($rp['amount'], 2); ?></span></td>
                                        <td class="text-end pe-4 text-muted small"><?php echo date('d M, Y', strtotime($rp['payment_date'])); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="card-header bg-white py-4 border-0">
                        <h5 class="m-0 fw-bold text-dark">Guddiga Deg-dega</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-grid gap-3">
                            <a href="student_add.php" class="quick-link-btn text-decoration-none p-3 rounded-3 d-flex align-items-center bg-light">
                                <div class="bg-primary text-white p-2 rounded-3 me-3"><i class="fas fa-user-plus fa-sm"></i></div>
                                <span class="text-dark fw-bold small">Kudar Arday Cusub</span>
                            </a>
                            <a href="attendance_add.php" class="quick-link-btn text-decoration-none p-3 rounded-3 d-flex align-items-center bg-light">
                                <div class="bg-success text-white p-2 rounded-3 me-3"><i class="fas fa-check-double fa-sm"></i></div>
                                <span class="text-dark fw-bold small">Xaadirinta Maanta</span>
                            </a>
                            <a href="payment_add.php" class="quick-link-btn text-decoration-none p-3 rounded-3 d-flex align-items-center bg-light">
                                <div class="bg-info text-white p-2 rounded-3 me-3"><i class="fas fa-file-invoice-dollar fa-sm"></i></div>
                                <span class="text-dark fw-bold small">Qaado Lacag-bixin</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


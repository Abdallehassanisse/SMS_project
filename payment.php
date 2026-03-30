<?php 
include("sidebar.php"); 
include("db.php");

// 1. Xisaabi dakhliga guud (Total Revenue)
$total_res = mysqli_query($link, "SELECT SUM(amount) as total FROM payment");
$total_data = mysqli_fetch_assoc($total_res);
$total_revenue = $total_data['total'] ?? 0;

// 2. Xisaabi tirada lacag bixinaha (Total Transactions)
$count_res = mysqli_query($link, "SELECT COUNT(id) as total_trans FROM payment");
$count_data = mysqli_fetch_assoc($count_res);
$total_transactions = $count_data['total_trans'] ?? 0;
?>

<div class="main" style="margin-left: 260px; background: #f8f9fa; min-height: 100vh; padding: 30px;">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Maareynta Lacagaha</h2>
                <p class="text-muted">La soco dakhliga iyo lacag bixinta ardayda</p>
            </div>
            <a href="payment_add.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> New Payment
            </a>
        </div>

        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3" style="background: linear-gradient(45deg, #4e73df, #224abe); color: white; border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle me-3">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                        <div>
                            <small class="opacity-75">Total Revenue</small>
                            <h3 class="fw-bold mb-0">$<?php echo number_format($total_revenue, 2); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3" style="background: linear-gradient(45deg, #1cc88a, #13855c); color: white; border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle me-3">
                            <i class="fas fa-receipt fa-2x"></i>
                        </div>
                        <div>
                            <small class="opacity-75">Total Transactions</small>
                            <h3 class="fw-bold mb-0"><?php echo $total_transactions; ?></h3>
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
                                <th class="ps-4 py-3">Receipt ID</th>
                                <th>Student Details</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query-ga isku xiraya payment, student iyo classes
                            $sql = "SELECT p.*, s.name as s_name, c.classname 
                                    FROM payment p
                                    JOIN student s ON p.studentid = s.id
                                    JOIN classes c ON s.classid = c.id
                                    ORDER BY p.id DESC";
                            $res = mysqli_query($link, $sql);
                            
                            while($row = mysqli_fetch_assoc($res)){
                            ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="text-primary fw-bold">#<?php echo $row['id']; ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px;">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold"><?php echo htmlspecialchars($row['s_name']); ?></div>
                                            <small class="text-muted"><?php echo $row['classname']; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="fw-bold text-dark">$<?php echo number_format($row['amount'], 2); ?></span></td>
                                <td><span class="badge rounded-pill bg-success-soft text-success px-3" style="background: #e1f6ed;">Paid</span></td>
                                <td>
                                    <div class="text-muted small">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <?php echo date('d M, Y', strtotime($row['payment_date'])); ?>
                                    </div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="payment_receipt.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm d-inline-flex align-items-center">
                                            <i class="fas fa-print me-1"></i> Receipt
                                        </a>

                                        <a href="payment_edit.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-outline-success btn-sm rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" 
                                           style="width: 52px; height: 52px;"
                                           >
                                            <i class="fas fa-trash-alt"></i>Edit
                                        </a>

                                        <a href="payment_delete.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-outline-danger btn-sm rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" 
                                           style="width: 52px; height: 52px;"
                                           onclick="return confirm('Ma hubtaa inaad tirtirto diiwaankan?')">
                                            <i class="fas fa-trash-alt"></i>Delete
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
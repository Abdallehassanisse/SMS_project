<?php
include("db.php");

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);

    // SQL Query isku xiraya Payment iyo Student
    $sql = "SELECT p.*, s.name as s_name, s.phone, c.classname 
            FROM payment p
            JOIN student s ON p.studentid = s.id
            JOIN classes c ON s.classid = c.id
            WHERE p.id='$id'";
    
    $res = mysqli_query($link, $sql);
    $data = mysqli_fetch_assoc($res);

    if(!$data) { die("Risiidhkan laguma helin database-ka."); }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - #<?php echo $id; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #f4f7f6; padding-top: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .receipt-container { max-width: 700px; margin: auto; background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid #eee; }
        .receipt-header { background: #4e73df; color: white; padding: 40px 20px; position: relative; }
        .receipt-header h2 { text-transform: uppercase; letter-spacing: 2px; font-weight: 800; margin: 0; }
        .receipt-body { padding: 40px; }
        .info-row { border-bottom: 1px dashed #ddd; padding: 12px 0; display: flex; justify-content: space-between; }
        .info-label { color: #888; font-weight: 600; text-transform: uppercase; font-size: 13px; }
        .info-value { color: #333; font-weight: 700; }
        .amount-box { background: #f8f9fc; border-radius: 15px; padding: 25px; margin-top: 30px; text-align: center; border: 2px solid #eef2f7; }
        .amount-text { font-size: 32px; font-weight: 800; color: #1cc88a; }
        .footer-note { font-size: 12px; color: #aaa; margin-top: 40px; text-align: center; }
        
        /* Batoonnada */
        .action-bar { max-width: 700px; margin: 20px auto; display: flex; gap: 10px; }
        
        @media print {
            .no-print { display: none !important; }
            body { background: white; padding: 0; }
            .receipt-container { box-shadow: none; border: none; margin: 0; width: 100%; max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="action-bar no-print">
    <button onclick="window.print()" class="btn btn-dark shadow-sm px-4 rounded-pill">
        <i class="fas fa-print me-2"></i> Daabac Risiidhka
    </button>
    <a href="payment.php" class="btn btn-outline-secondary shadow-sm px-4 rounded-pill">
        <i class="fas fa-arrow-left me-2"></i> Dib u noqo
    </a>
</div>

<div class="receipt-container">
    <div class="receipt-header text-center">
        <h2>SMS SYSTEM</h2>
        <p class="mb-0 opacity-75">Risiidhka Lacag Bixinta Rasmiga Ah</p>
    </div>

    <div class="receipt-body">
        <div class="row mb-4">
            <div class="col-6">
                <div class="info-label">Receipt Number</div>
                <div class="info-value text-primary">#REC-<?php echo str_pad($data['id'], 5, '0', STR_PAD_LEFT); ?></div>
            </div>
            <div class="col-6 text-end">
                <div class="info-label">Payment Date</div>
                <div class="info-value"><?php echo date('d F, Y', strtotime($data['payment_date'])); ?></div>
            </div>
        </div>

        <div class="info-row">
            <span class="info-label">Student Name</span>
            <span class="info-value"><?php echo htmlspecialchars($data['s_name']); ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Class / Section</span>
            <span class="info-value"><?php echo $data['classname']; ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Contact Phone</span>
            <span class="info-value"><?php echo $data['phone']; ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Description / Note</span>
            <span class="info-value"><?php echo $data['remark'] ?: 'School Fees'; ?></span>
        </div>

        <div class="amount-box">
            <div class="info-label mb-2">Total Amount Paid</div>
            <div class="amount-text">$<?php echo number_format($data['amount'], 2); ?></div>
            <div class="badge bg-success mt-2 px-3 py-2 rounded-pill">STATUS: PAID</div>
        </div>

        <div class="row mt-5 pt-4 text-center">
            <div class="col-6">
                <div style="border-top: 1px solid #eee; width: 80%; margin: auto; padding-top: 10px;">
                    <small class="text-muted">Student Signature</small>
                </div>
            </div>
            <div class="col-6">
                <div style="border-top: 1px solid #eee; width: 80%; margin: auto; padding-top: 10px;">
                    <small class="text-muted">Cashier Signature</small>
                </div>
            </div>
        </div>

        <div class="footer-note">
            <p>Mahadsanid! Lacagtan waa mid loo qabtay adeegga waxbarashada.<br>
            Tani waa risiidh si elektaroonig ah loogu soo saaray nidaamka SMS.</p>
        </div>
    </div>
</div>

</body>
</html>
<?php
include("db.php");
include("sidebar.php");

// 1. Markii la riixo batoonka Confirm & Save Payment
if(isset($_POST['save_payment'])){
    // Waxaan isticmaalnaa magacyada u qoran jaantuskaaga (image_44ccaf.png)
    $studentid     = mysqli_real_escape_string($link, $_POST['studentid']);
    $amount        = mysqli_real_escape_string($link, $_POST['amount']);
    $payment_date  = mysqli_real_escape_string($link, $_POST['payment_date']); // Sax: payment_date
    $remark        = mysqli_real_escape_string($link, $_POST['remark']);       // Sax: remark (ma ahan remarks)

    // SQL Query: Waxaan u waafajinay columns-ka database-kaaga
    $sql = "INSERT INTO payment (studentid, amount, payment_date, remark) 
            VALUES ('$studentid', '$amount', '$payment_date', '$remark')";
    
    if(mysqli_query($link, $sql)){
        echo "<script>
                alert('Lacagta si guul leh ayaa loo qabtay!');
                window.location='payment.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Cilad: " . mysqli_error($link) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .main { margin-left: 260px; background-color: #f8f9fc; padding: 40px; }
        .card { border: none; border-radius: 15px; }
        .card-header { border-radius: 15px 15px 0 0 !important; background: #4e73df; color: white; }
        .form-label { font-weight: 600; color: #4e73df; }
    </style>
</head>
<body>

<div class="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header py-3 text-center">
                        <h4 class="m-0"><i class="fas fa-file-invoice-dollar me-2"></i> Diiwaangeli Lacag Bixin Cusub</h4>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label class="form-label">Ardayga Bixinaya:</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-user-graduate"></i></span>
                                        <select name="studentid" class="form-select" required>
                                            <option value="">-- Ka dooro ardayda --</option>
                                            <?php
                                            $students = mysqli_query($link, "SELECT id, name FROM student ORDER BY name ASC");
                                            while($s = mysqli_fetch_assoc($students)){
                                                echo "<option value='".$s['id']."'>".$s['name']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Lacagta la bixiyay ($):</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold">$</span>
                                        <input type="number" name="amount" class="form-control" placeholder="0.00" step="0.01" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Taariikhda:</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" name="payment_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label">Faahfaahin (Remark):</label>
                                    <textarea name="remark" class="form-control" rows="2" placeholder="Tusaale: Payment for January Tuition Fee"></textarea>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="save_payment" class="btn btn-success btn-lg shadow">
                                    <i class="fas fa-save me-2"></i> Save Payment
                                </button>
                                <a href="payment.php" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
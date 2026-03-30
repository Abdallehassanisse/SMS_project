<?php
include("db.php");
include("sidebar.php");

// 1. Soo saar xogta hadda jirta si loogu muujiyo foomka
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $res = mysqli_query($link, "SELECT * FROM payment WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
}

// 2. Markii la riixo batoonka Update
if(isset($_POST['update_payment'])){
    $studentid     = mysqli_real_escape_string($link, $_POST['studentid']);
    $amount        = mysqli_real_escape_string($link, $_POST['amount']);
    $payment_date  = mysqli_real_escape_string($link, $_POST['payment_date']); // payment_date
    $remark        = mysqli_real_escape_string($link, $_POST['remark']);       // remark

    $update_sql = "UPDATE payment SET 
                   studentid='$studentid', 
                   amount='$amount', 
                   payment_date='$payment_date', 
                   remark='$remark' 
                   WHERE id='$id'";

    if(mysqli_query($link, $update_sql)){
        echo "<script>
                alert('Xogta lacagta si guul leh ayaa loo cusuboneysiiyay!');
                window.location='payment.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Cilad: " . mysqli_error($link) . "</div>";
    }
}
?>

<div class="main" style="margin-left: 260px; padding: 40px; background: #f8f9fc; min-height: 100vh;">
    <div class="container">
        <div class="card shadow-sm border-0" style="border-radius: 15px; max-width: 600px; margin: auto;">
            <div class="card-header bg-success text-white py-3" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Wax ka beddel Lacag Bixinta #<?php echo $id; ?></h5>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ardayga:</label>
                        <select name="studentid" class="form-select" required>
                            <?php
                            $students = mysqli_query($link, "SELECT id, name FROM student");
                            while($s = mysqli_fetch_assoc($students)){
                                $selected = ($s['id'] == $row['studentid']) ? "selected" : "";
                                echo "<option value='".$s['id']."' $selected>".$s['name']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Lacagta ($):</label>
                            <input type="number" name="amount" class="form-control" value="<?php echo $row['amount']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Taariikhda:</label>
                            <input type="date" name="payment_date" class="form-control" value="<?php echo $row['payment_date']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Faahfaahin (Remark):</label>
                        <textarea name="remark" class="form-control" rows="3"><?php echo $row['remark']; ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="update_payment" class="btn btn-success px-4 py-2">
                            <i class="fas fa-save me-2"></i> Save Changes
                        </button>
                        <a href="payment.php" class="btn btn-outline-secondary px-4 py-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
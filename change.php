<?php 
session_start();
include("db.php");
include("sidebar.php");

// Hubi in qofku login yahay
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}

$msg = "";
$user_id = $_SESSION['user_id'];

if(isset($_POST['change_pass'])){
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $confirm  = $_POST['confirm_password'];

    // 1. Soo qaado password-ka hadda ee database-ka ku jira
    $res = mysqli_query($link, "SELECT password FROM users WHERE id='$user_id'");
    $row = mysqli_fetch_assoc($res);

    // 2. Xaqiiji haddii password-ka hore uu sax yahay
    if(password_verify($old_pass, $row['password'])){
        
        // 3. Hubi in labada password ee cusub ay is leeyihiin
        if($new_pass === $confirm){
            $hashed_new = password_hash($new_pass, PASSWORD_DEFAULT);
            
            // 4. Cusboonaysii database-ka
            $update = mysqli_query($link, "UPDATE users SET password='$hashed_new' WHERE id='$user_id'");
            
            if($update){
                $msg = "<div class='alert alert-success'>Password-ka si guul leh ayaa loo beddelay!</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Password-ka cusub iyo xaqiijintiisa isma laha!</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Password-kaaga hore waa khalad!</div>";
    }
}
?>

<div class="main" style="margin-left: 260px; background: #f4f7fe; min-height: 100vh; padding: 40px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 25px;">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary d-inline-block p-3 rounded-circle mb-3">
                            <i class="fas fa-key fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Beddel Password-ka</h3>
                        <p class="text-muted small">Hubi inaad isticmaashid password adag.</p>
                    </div>

                    <?php echo $msg; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">PASSWORD-KA HORE</label>
                            <input type="password" name="old_password" class="form-control p-3 border-0 bg-light" required>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label fw-bold small">PASSWORD-KA CUSUB</label>
                            <input type="password" name="new_password" class="form-control p-3 border-0 bg-light" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small">XAQIIJI PASSWORD-KA CUSUB</label>
                            <input type="password" name="confirm_password" class="form-control p-3 border-0 bg-light" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="change_pass" class="btn btn-primary p-3 rounded-pill fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> Beddel Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
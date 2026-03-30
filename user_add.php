<?php 
include("db.php");
include("sidebar.php");

$msg = "";
if(isset($_POST['save_user'])){
    // Waxaan isticmaalaynaa Email halkii aan ka isticmaali lahayn Username
    $email    = mysqli_real_escape_string($link, $_POST['email']);
    $status   = mysqli_real_escape_string($link, $_POST['user_status']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // 1. Hubi haddii labada password ay is leeyihiin
    if($password !== $confirm){
        $msg = "<div class='alert alert-danger'>Labada password isma laha!</div>";
    } else {
        // 2. Hash garee Password-ka (Aad u muhiim ah!)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 3. Geli Database-ka (Email, Password, iyo Status)
        $sql = "INSERT INTO users (email, password, user_status) VALUES ('$email', '$hashed_password', '$status')";
        
        if(mysqli_query($link, $sql)){
            $msg = "<div class='alert alert-success'>User-ka cusub si guul leh ayaa loo kaydiyey!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Khalad: " . mysqli_error($link) . "</div>";
        }
    }
}
?>

<div class="main" style="margin-left: 260px; background: #f4f7fe; min-height: 100vh; padding: 40px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 25px;">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary d-inline-block p-3 rounded-circle mb-3">
                            <i class="fas fa-user-plus fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Diiwaangeli User</h3>
                        <p class="text-muted">Geli email-ka iyo password-ka maamulaha.</p>
                    </div>

                    <?php echo $msg; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email-ka User-ka</label>
                            <input type="email" name="email" class="form-control p-3 border-0 bg-light" placeholder="tusaale@mail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">User Status</label>
                            <select name="user_status" class="form-select p-3 border-0 bg-light" required>
                                <option value="Active">Active (Wuu furi karaa)</option>
                                <option value="Inactive">Inactive (Waa laga xiray)</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" name="password" class="form-control p-3 border-0 bg-light" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Xaqiiji Password</label>
                                <input type="password" name="confirm_password" class="form-control p-3 border-0 bg-light" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="save_user" class="btn btn-primary p-3 rounded-pill fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> Kaydi User-ka
                            </button>
                            <a href="user.php" class="btn btn-light p-3 rounded-pill fw-bold">Ku noqo liiska</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
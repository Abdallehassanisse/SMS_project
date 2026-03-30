<?php 
include("db.php");
include("sidebar.php");

// 1. Soo qaado xogta user-ka la rabo in wax laga beddelo
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $res = mysqli_query($link, "SELECT * FROM users WHERE id='$id'");
    $user = mysqli_fetch_assoc($res);
}

$msg = "";
if(isset($_POST['update_user'])){
    $email  = mysqli_real_escape_string($link, $_POST['email']);
    $status = mysqli_real_escape_string($link, $_POST['user_status']);
    $pass   = $_POST['password'];

    // 2. Hubi haddii password cusub la qoray
    if(!empty($pass)){
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET email='$email', password='$hashed_password', user_status='$status' WHERE id='$id'";
    } else {
        // Haddii password-ka la deysto (aan waxba la qorin), ha beddelin password-ka hore
        $sql = "UPDATE users SET email='$email', user_status='$status' WHERE id='$id'";
    }

    if(mysqli_query($link, $sql)){
        $msg = "<div class='alert alert-success'>Xogta user-ka waa la cusboonaysiiyey!</div>";
        echo "<meta http-equiv='refresh' content='2'>"; // Bogga cusboonaysii 2 ilbidhiqsi ka dib
    } else {
        $msg = "<div class='alert alert-danger'>Khalad: " . mysqli_error($link) . "</div>";
    }
}
?>

<div class="main" style="margin-left: 260px; background: #f4f7fe; min-height: 100vh; padding: 40px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 25px;">
                    <div class="text-center mb-4">
                        <div class="bg-warning bg-opacity-10 text-warning d-inline-block p-3 rounded-circle mb-3">
                            <i class="fas fa-user-edit fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Wax ka beddel User</h3>
                        <p class="text-muted">Wax ka beddel xogta: <b><?php echo $user['email']; ?></b></p>
                    </div>

                    <?php echo $msg; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email-ka</label>
                            <input type="email" name="email" class="form-control p-3 border-0 bg-light" value="<?php echo $user['email']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">User Status</label>
                            <select name="user_status" class="form-select p-3 border-0 bg-light">
                                <option value="Active" <?php if($user['user_status'] == 'Active') echo 'selected'; ?>>Active</option>
                                <option value="Inactive" <?php if($user['user_status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Cusub (Haddii aad rabto inaad beddesho)</label>
                            <input type="password" name="password" class="form-control p-3 border-0 bg-light" placeholder="Ku daa maran haddii aadan beddelayn">
                            <small class="text-muted">Haddii aad rabto inaad password-kii hore deysato, meeshan waxba ha ku qorin.</small>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="update_user" class="btn btn-warning p-3 rounded-pill fw-bold shadow-sm text-white">
                                <i class="fas fa-sync-alt me-2"></i> Cusboonaysii User-ka
                            </button>
                            <a href="user.php" class="btn btn-light p-3 rounded-pill fw-bold">Jooji / Dib u noqo</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
session_start();
include("db.php");

$error = "";
if (isset($_POST['login'])) {
    // Waxaan isticmaalaynaa Email maadaama uusan jirin Username miiskaaga
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = $_POST['password'];

    // Ka soo saar user-ka leh email-kan
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($link, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // 1. Hubi haddii user-ka uu yahay 'Active'
        if ($row['user_status'] !== 'Active') {
            $error = "User-kan waa laga xiray nidaamka (Inactive)!";
        } 
        // 2. Isbarbar-dhig password-ka (Hashed vs Plain)
        else if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['email']; // Maadaama aysan jirin 'name', email-ka isticmaal
            
            header("location: dashboard.php");
            exit();
        } else {
            $error = "Password-ka aad gelisay waa khalad!";
        }
    } else {
        $error = "Email-kan ma jiro!";
    }
}
?>

<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <title>Login - School System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #f4f7fe; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; }
        .login-card { border-radius: 30px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.1); width: 420px; padding: 45px; background: #fff; }
        .btn-login { border-radius: 50px; padding: 14px; font-weight: bold; background: #4e73df; border: none; transition: 0.3s; }
        .btn-login:hover { background: #224abe; transform: translateY(-2px); }
        .form-control { background: #f8f9fc; border: 2px solid transparent; padding: 15px; border-radius: 15px; transition: 0.3s; }
        .form-control:focus { background: #fff; border-color: #4e73df; box-shadow: none; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-5">
        <div class="bg-primary bg-opacity-10 text-primary d-inline-block p-4 rounded-circle mb-3">
            <i class="fas fa-school fa-2x"></i>
        </div>
        <h3 class="fw-bold text-dark">SMS Login</h3>
        <p class="text-muted">Geli email-kaaga si aad u gasho</p>
    </div>

    <?php if($error): ?>
        <div class="alert alert-danger text-center py-2 mb-4" style="border-radius: 12px; font-size: 14px;">
            <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold text-muted ps-2">EMAIL ADDRESS</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0" style="border-radius: 15px 0 0 15px;"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control" placeholder="user@school.com" style="border-radius: 0 15px 15px 0;" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label small fw-bold text-muted ps-2">PASSWORD</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0" style="border-radius: 15px 0 0 15px;"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control" placeholder="••••••••" style="border-radius: 0 15px 15px 0;" required>
            </div>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100 btn-login shadow-sm mb-3">
            Gasho Nidaamka <i class="fas fa-sign-in-alt ms-2"></i>
        </button>
    </form>
    
    <div class="text-center">
        <small class="text-muted">Ma ilowday Password-ka? La xiriir Admin-ka.</small>
    </div>
</div>

</body>
</html>
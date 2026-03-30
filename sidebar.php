<?php
// 1. Bilow Session-ka
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Hubi haddii user_id uu jiro (Login ma soo sameeyay?)
if (!isset($_SESSION['user_id'])) {
    // Haddii uusan soo marin login, u tuur bogga login.php
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
body { font-family: "Lato", sans-serif; }

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 15px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

.sidenav a:hover, .dropdown-btn:hover { color: #f1f1f1; }

.main {
  margin-left: 200px; 
  padding: 0px 10px;
}

.active {
  background-color: green;
  color: white;
}

.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

.fa-caret-down {
  float: right;
  padding-right: 8px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="sidenav">
  <div class="text-center mb-3">
      <h5 class="text-white fw-bold"><i class="fa fa-university"></i> SMS PRO</h5>
      <!-- <small class="text-muted"><?php echo $_SESSION['email']; ?></small> -->
  </div>
  <hr class="text-secondary">
  
  <a href="dashboard.php"> <i class="fa fa-dashboard"></i> Dashboard</a>
  <a href="faculty.php"> <i class="fa fa-user"></i> Faculty</a>
  <a href="department.php"> <i class="fa fa-building"></i> Department</a>
  <a href="class.php"> <i class="fa fa-graduation-cap"></i> Class</a>
  <a href="student.php"> <i class="fa fa-user"></i> Student</a>
  <a href="payment.php"> <i class="fa fa-money"></i> Payment</a>
  <a href="courses.php"> <i class="fa fa-book"></i> Courses</a>
  <a href="attendance.php"> <i class="fa fa-calendar-check-o"></i> Attendance</a>
  
  <button class="dropdown-btn">
    <i class="fa fa-cog"></i> Account Settings
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="user.php"> <i class="fa fa-user-plus"></i> Create user</a>
    <a href="change.php"> <i class="fa fa-key"></i> change password</a>
    <a href="logout.php"> <i class="fa fa-sign-out"></i> logout</a>
  </div>
</div>

<div class="main">
    </div>

<script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>

</body>
</html>
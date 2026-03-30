<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);

    // 1. Marka hore masax xogta Xaadirinta (Attendance) ee ardaygaas leeyahay
    // Tani waxay ka hortagaysaa Foreign Key Error-ka
    mysqli_query($link, "DELETE FROM attendance WHERE studentid = '$id'");

    // 2. Masax xogta Lacag bixinta (Payment) ee ardaygaas leeyahay
    mysqli_query($link, "DELETE FROM payment WHERE studentid = '$id'");

    // 3. Ugu dambeyn, masax ardayga laftiisa ee jadwalka student
    $sql = "DELETE FROM student WHERE id = '$id'";

    if (mysqli_query($link, $sql)) {
        echo "<script>
                alert('Ardayga iyo dhammaan xogtiisii ku xirnayn si guul leh ayaa loo masaxay!');
                window.location.href = 'student.php';
              </script>";
    } else {
        echo "<script>
                alert('Cilad: Ma suurtagalin in la masaxo ardayga. " . mysqli_error($link) . "');
                window.location.href = 'student.php';
              </script>";
    }
} else {
    header("Location: student.php");
    exit();
}
?>
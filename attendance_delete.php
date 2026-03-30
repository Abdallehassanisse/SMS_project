<?php
include("db.php");

// 1. Hubi haddii ID-ga xaadirinta la soo diray (URL parameter)
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);

    // 2. SQL Query si loo masaxo diiwaanka gaarka ah ee jadwalka attendance
    $sql = "DELETE FROM attendance WHERE id = '$id'";

    if (mysqli_query($link, $sql)) {
        // 3. Haddii ay si guul leh u masaxanto, dib ugu celi bogga attendance.php
        echo "<script>
                alert('Diiwaanka xaadirinta si guul leh ayaa loo masaxay!');
                window.location.href = 'attendance.php';
              </script>";
    } else {
        // Haddii ay cilad dhacdo
        echo "<script>
                alert('Cilad ayaa dhacday: " . mysqli_error($link) . "');
                window.location.href = 'attendance.php';
              </script>";
    }
} else {
    // Haddii si toos ah loo soo galo boggan iyadoo aan ID la soo dirin
    header("Location: attendance.php");
    exit();
}
?>
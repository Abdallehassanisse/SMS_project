<?php
include("db.php");

// 1. Hubi haddii ID-ga lacagta la soo diray (URL parameter)
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);

    // 2. SQL Query si loo masaxo diiwaanka lacagta ee jadwalka payment
    // Waxaan isticmaalnaa column-ka 'id' ee jadwalkaaga
    $sql = "DELETE FROM payment WHERE id = '$id'";

    if (mysqli_query($link, $sql)) {
        // 3. Haddii ay si guul leh u masaxanto, dib ugu celi bogga payment.php
        echo "<script>
                alert('Diiwaanka lacagta si guul leh ayaa loo masaxay!');
                window.location.href = 'payment.php';
              </script>";
    } else {
        // Haddii ay cilad dhacdo
        echo "Cilad ayaa dhacday: " . mysqli_error($link);
    }
} else {
    // Haddii si toos ah loo soo galo boggan iyadoo aan ID la soo dirin
    header("Location: payment.php");
    exit();
}
?>
<?php
include("db.php");

// 1. Hubi haddii ID-ga maadada la soo diray (URL parameter)
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);

    // 2. SQL Query si loo masaxo maadada gaarka ah ee jadwalka courses
    $sql = "DELETE FROM courses WHERE id = '$id'";

    if (mysqli_query($link, $sql)) {
        // 3. Haddii ay si guul leh u masaxanto, dib ugu celi bogga courses.php
        echo "<script>
                alert('Maadada si guul leh ayaa loo masaxay!');
                window.location.href = 'courses.php';
              </script>";
    } else {
        // Haddii ay cilad dhacdo (tusaale: haddii maaddadu ku xiran tahay Attendance ama Payment)
        echo "<script>
                alert('Cilad: Maadadan lama masaxi karo waayo waxay ku xiran tahay xog kale.');
                window.location.href = 'courses.php';
              </script>";
    }
} else {
    // Haddii si toos ah loo soo galo boggan iyadoo aan ID la soo dirin
    header("Location: courses.php");
    exit();
}
?>
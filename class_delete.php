<?php
include("db.php");

// 1. Soo qaado ID-ga fasalka la rabo in la masaxo
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // 2. Qoraalka SQL-ka ee lagu masaxayo fasalka
    // Waxaan ka masaxaynaa jadwalka 'classes' sida ku cad ER Diagram-kaaga
    $query = mysqli_query($link, "DELETE FROM classes WHERE id='$id'");

    if($query){
        // 3. Haddii uu guulaysto, soo saar farriin oo ku celi bogga liiska
        echo "<script>
                alert('Fasalka si guul leh ayaa loo masaxay');
                window.location='class.php';
              </script>";
    } else {
        // Haddii ay cilad dhacdo (tusaale haddii arday ku xiran tahay)
        echo "Cilad ayaa dhacday: " . mysqli_error($link);
    }
} else {
    echo "<script>window.location='class.php';</script>";
}
?>
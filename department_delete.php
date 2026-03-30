<?php
include("db.php");

// 1. Soo qaado ID-ga department-ga la rabo in la masaxo
$id = $_REQUEST['id'];

// 2. Qoraalka SQL-ka ee masaxista
$query = mysqli_query($link, "DELETE FROM department WHERE id='$id'");

// 3. Farriin u dir isticmaalaha ka dibna ku celi bogga liiska
if($query){
?>
    <script>
        alert("Department-ga si guul leh ayaa loo masaxay");
        window.location="departmentlist.php";
    </script>
<?php
} else {
    echo "Cilad ayaa dhacday: " . mysqli_error($link);
}
?>
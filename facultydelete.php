<?php
include("db.php");
$id=$_REQUEST['id'];

$query=mysqli_query($link,"DELETE FROM faculty where id='".$id."'");
?>
<script>
    alert("deleted successfully")
    window.location="facultylist.php"
    </script>
<?php 
include("db.php");
$name=$_POST['facultyname'];
$description=$_POST['description'];
#check whether faculty exist or not
$check=mysqli_query($link,"SELECT * FROM faculty where name ='".$name."'");
if(mysqli_num_rows($check)>0){
    ?>
    <script>
        alert("the same faculty name already in the database");
        window.location="facultylist.php";
        </script>
        <?php
}
else{
$sql=mysqli_query($link,"INSERT INTO faculty(name,description) values('$name','$description')");
if($sql){
    ?>
    <script>
        alert("faculty created successfully");
        window.location="facultylist.php";
        </script>
        <?php
}
}
?>
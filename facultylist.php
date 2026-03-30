<?php
include("sidebar.php");
include("db.php");
?>
<div class="main">
    <div class="container_fluid">
        <div class="card">
            <div class="card-header">Faculty List</div>
            <div class="card-body">
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Faculty</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>

  <tbody>
    <?php
    $sql=mysqli_query($link,"SELECT * FROM faculty ORDER BY name ");
    while($data=mysqli_fetch_array($sql)){
        echo "<tr>";
        echo "<td>".$data['id']."</td>";
        echo "<td>".$data['name']."</td>";
        ?>
        <td>
            <a href="facultyedit.php?id=<?php echo $data['id'];?>"class="btn btn-success btn-sm">Edit</a>
<a href="facultydelete.php?id=<?php echo $data['id'];?>"class="btn btn-danger btn-sm" onclick="return confirm('are you to delete this faculty [<?php echo $data['name'];?>]')">Delete</a>
    </tr>
    <?php

    }

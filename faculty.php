<?php
include "sidebar.php";
?>
<div class ="main">
   <div class="container-fluid">

   <div class="card">
  <div class="card-header">Faculty</div>
  <div class="card-body">
    <form action="faculty_save.php"method="post">
        <label>Faculty Name</label>
        <input type="text"class="form-control form-control-sm" name="facultyname">
        <label>Faculty Description</label>
        <textarea class="form-control form-control-sm" name="description"row="30"cols="3">
</textarea>
        
        <input type="submit"value="Save"name="btn_save"class="btn btn-primary btn-sm mt-3">

  </div>
  
</div>
</div>





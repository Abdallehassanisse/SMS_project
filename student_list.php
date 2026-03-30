<?php 
include("sidebar.php"); 
include("db.php");
?>
<div class="main">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Ardayda Diiwaangashan (Student List)</h2>
            <a href="student_add.php" class="btn btn-primary shadow-sm">+ Add New Student</a>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>FullName</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Waxaan isku xiraynaa student iyo classes si aan u helno magaca fasalka (classname)
                        $sql = "SELECT s.*, c.classname 
                                FROM student s 
                                LEFT JOIN classes c ON s.classid = c.id";
                        $res = mysqli_query($link, $sql);
                        
                        while($row = mysqli_fetch_assoc($res)){
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td>
                                <span class="badge <?php echo ($row['gender'] == 'Male') ? 'bg-info' : 'bg-danger'; ?>">
                                    <?php echo $row['gender']; ?>
                                </span>
                            </td>
                            <td><?php echo $row['classname'] ?? 'No Class'; ?></td>
                            <td>$<?php echo number_format($row['tution_fee'], 2); ?></td>
                            <td>
                                <a href="student_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm ">Edit</a>
                                <a href="student_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ma hubtaa?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="mid-section">
    <h2>Student List</h2>
    <a href="create.php" class="btn-add-student">Add New Student</a>
     <table>
         <tr>
             <th>ID</th>
             <th>Student Name</th>
             <th>Student Email</th>
             <th>Student Course</th>
             <th>Actions</th>
         </tr>
         <?php foreach ($students as $student ): ?>
             <tr>
               <td><?=$student['id']?></td>
               <td><?=$student['name']?></td>
               <td><?=$student['email']?></td>
               <td><?=$student['course']?></td>
               <td>
                   <a href="edit.php?id=<?= $student['id'] ?>">Edit</a>
                   <a href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
               </td>
             </tr>
         <?php endforeach ?>
     </table>
</div>
</body>
</html>
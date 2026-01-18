

<?php $__env->startSection('content'); ?>

<a href="index.php?page=create">➕ Add Student</a>

<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Actions</th>
    </tr>

    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($student['id']); ?></td>
        <td><?php echo e($student['name']); ?></td>
        <td><?php echo e($student['email']); ?></td>
        <td><?php echo e($student['course']); ?></td>
        <td>
            <a href="index.php?page=edit&id=<?php echo e($student['id']); ?>">Edit</a>
            <a href="index.php?page=delete&id=<?php echo e($student['id']); ?>"
               onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Workshop\Workshop-8\app\views/students/index.blade.php ENDPATH**/ ?>
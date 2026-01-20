

<?php $__env->startSection('content'); ?>

<h2>Edit Student</h2>

<form method="POST" action="index.php?page=update&id=<?php echo e($student['id']); ?>">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo e($student['name']); ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo e($student['email']); ?>" required><br><br>

    <label>Course:</label><br>
    <input type="text" name="course" value="<?php echo e($student['course']); ?>" required><br><br>

    <button type="submit">Update</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Workshop\Workshop-8\app\views/students/edit.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>

<h2>Add Student</h2>

<form method="POST" action="index.php?page=store">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Course:</label><br>
    <input type="text" name="course" required><br><br>

    <button type="submit">Save</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Workshop\Workshop-8\app\views/students/create.blade.php ENDPATH**/ ?>
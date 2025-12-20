<?php
include 'includes/header.php';
include 'functions/functions.php';

$file = 'data/students.txt';
$students = [];

if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $students[] = json_decode($line, true);
    }
}
?>

<h2>All Students</h2>

<?php if (empty($students)) {
    echo "<p>No students found.</p>";
} else { ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Skills</th>
        </tr>
        <?php foreach ($students as $s) { ?>
            <tr>
                <td><?php echo htmlspecialchars($s['name']); ?></td>
                <td><?php echo htmlspecialchars($s['email']); ?></td>
                <td><?php echo htmlspecialchars(implode(', ', $s['skills'])); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>

<?php include 'includes/footer.php'; ?>

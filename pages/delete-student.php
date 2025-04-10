<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Prepare and execute delete query
    $sql = "DELETE FROM student WHERE SID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);

    if ($stmt->execute()) {
        echo "<script>
                    alert('Book deleted successfully!');
                    window.location.href='http://localhost/library/index.php?page=view_book.php';
                </script>";
        exit();
    } else {
        echo "Error deleting student: " . $conn->error;
    }
} else {
    echo "No student ID provided!";
}
?>

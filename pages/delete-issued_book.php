<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $issueId = $_GET['id'];

    $sql = "DELETE FROM student_book WHERE IssueID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $issueId);

    if ($stmt->execute()) {
        echo "<script>
            alert('Issued book deleted successfully!');
            window.location.href='http://localhost/library/index.php?page=view_issued_books.php';
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "<script>
        alert('No Issue ID provided!');
        window.location.href='http://localhost/library/index.php?page=view_issued_books.php';
    </script>";
}

$conn->close();
?>

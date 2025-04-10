<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $issueID = $_GET['id'];

    $deleteSql = "DELETE FROM student_book WHERE IssueID = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $issueID);

    if ($stmt->execute()) {
        echo "<script>
            alert('Returned book deleted successfully!');
            window.location.href='http://localhost/library/index.php?page=view_returned_books.php';
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "<script>
        alert('No book selected!');
        window.location.href='http://localhost/library/index.php?page=view_returned_books.php';
    </script>";
}

$conn->close();
?>

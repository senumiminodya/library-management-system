<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Delete the book
    $deleteQuery = "DELETE FROM book WHERE BID = '$bookId'";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "<script>
            alert('Book deleted successfully!');
            window.location.href='http://localhost/library/index.php?page=view_book.php';
        </script>";
    } else {
        echo "Error deleting book: " . $conn->error;
    }
} else {
    echo "<script>
        alert('No book ID provided!');
        window.location.href='http://localhost/library/index.php?page=view_book.php';
    </script>";
}

$conn->close();
?>

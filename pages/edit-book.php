<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Fetch the book details
    $bookQuery = "SELECT * FROM book WHERE BID = '$bookId'";
    $bookResult = $conn->query($bookQuery);

    if ($bookResult->num_rows > 0) {
        $book = $bookResult->fetch_assoc();
    } else {
        echo "<script>
            alert('Book not found!');
            window.location.href='http://localhost/library/index.php?page=view_books.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('No book ID provided!');
        window.location.href='http://localhost/library/index.php?page=view_books.php';
    </script>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookName = $_POST['bookName'];
    $author = $_POST['author'];
    $count = $_POST['count'];

    $updateQuery = "UPDATE book SET BName = '$bookName', Author = '$author', Count = '$count' WHERE BID = '$bookId'";

    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>
            alert('Book updated successfully!');
            window.location.href='http://localhost/library/index.php?page=view_book.php';
        </script>";
    } else {
        echo "Error updating book: " . $conn->error;
    }
}
?>

<div class="edit-book-container">
    <h2>Edit Book</h2>
    <form method="POST">
        <label for="bookName">Book Name:</label>
        <input type="text" id="bookName" name="bookName" value="<?php echo htmlspecialchars($book['BName']); ?>" required>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['Author']); ?>" required>

        <label for="count">Count:</label>
        <input type="number" id="count" name="count" value="<?php echo htmlspecialchars($book['Count']); ?>" required>

        <button type="submit" class="btn-submit">Update Book</button>
    </form>
</div>

<style>
    .edit-book-container {
        padding: 40px;
        max-width: 400px;
        margin: auto;
        font-family: Arial, sans-serif;
    }

    .edit-book-container h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #2c3e50;
    }

    .edit-book-container form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .edit-book-container label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
    }

    .edit-book-container input[type="text"],
    .edit-book-container input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .edit-book-container .btn-submit {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #27ae60;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
    }

    .edit-book-container .btn-submit:hover {
        background-color: #219150;
    }
</style>

<?php
$conn->close();
?>

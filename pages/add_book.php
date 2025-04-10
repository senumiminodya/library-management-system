<?php
include 'connect.php'; // DB connection

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = trim($_POST['bid']);
    $bookName = trim($_POST['bookName']);
    $author = trim($_POST['author']);
    $count = intval($_POST['count']);

    $stmt = $conn->prepare("INSERT INTO book (BID, BName, Author, Count) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $bookId, $bookName, $author, $count);

    if ($stmt->execute()) {
            // Set message and use header for redirection
            $message = "Book added successfully!";
            header("Location: index.php?page=view_book.php&message=" . urlencode($message));
            exit();
        } else {
            $message = "Error: " . $stmt->error;
        }

    $stmt->close();
}
?>
<?php if (!empty($message)): ?>
<script>
    alert("<?= htmlspecialchars($message) ?>");
</script>
<?php endif; ?>

<div class="add-book-container">
    <h2>Add New Book</h2>
    <!-- Only this line is updated: method and action -->
    <form id="bookForm" method="POST" action="">
        <label for="bid">Book ID:</label>
        <input type="text" id="bid" name="bid" required>

        <label for="bookName">Book Name:</label>
        <input type="text" id="bookName" name="bookName" required>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>

        <label for="count">Count:</label>
        <input type="number" id="count" name="count" min="1" required>

        <div class="btn-group">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>

<style>
    .add-book-container h2 {
        margin-bottom: 20px;
    }

    .add-book-container form {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 10px;
        max-width: 400px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .add-book-container label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    .add-book-container input[type="text"],
    .add-book-container input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #aaa;
        border-radius: 5px;
    }

    .add-book-container .btn-group {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }

    .add-book-container button {
        flex: 1;
        margin: 0 5px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .add-book-container .btn-submit {
        background-color: #27ae60;
    }

    .add-book-container .btn-submit:hover {
        background-color: #219150;
    }

    .add-book-container .btn-update {
        background-color: #f39c12;
    }

    .add-book-container .btn-update:hover {
        background-color: #d68910;
    }

    .add-book-container .btn-delete {
        background-color: #e74c3c;
    }

    .add-book-container .btn-delete:hover {
        background-color: #c0392b;
    }
</style>
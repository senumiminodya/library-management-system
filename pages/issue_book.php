<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $issueId = $_POST['bid'];
    $studentId = $_POST['studentId'];
    $bookId = $_POST['bookId'];
    $issueDate = $_POST['issueDate'];

    // 1. Check if the book is available
    $checkBookQuery = "SELECT Count FROM book WHERE BID = '$bookId'";
    $bookResult = $conn->query($checkBookQuery);

    if ($bookResult->num_rows > 0) {
        $book = $bookResult->fetch_assoc();
        if ($book['Count'] > 0) {
            // 2. Issue the book (insert into student_book table)
            $insertQuery = "INSERT INTO student_book (IssueID, SID, BID, IssueDate)
                            VALUES ('$issueId', '$studentId', '$bookId', '$issueDate')";

            if ($conn->query($insertQuery) === TRUE) {
                // 3. Decrease the count in book table
                $updateBookCount = "UPDATE book SET Count = Count - 1 WHERE BID = '$bookId'";
                $conn->query($updateBookCount);

                echo "<script>
                    alert('Book issued successfully!');
                    window.location.href='http://localhost/library/index.php?page=view_issued_books.php';
                </script>";
            } else {
                echo "Error issuing book: " . $conn->error;
            }

        } else {
            echo "<script>alert('Book not available!'); window.location.href='issue_book.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid Book ID!'); window.location.href='issue_book.php';</script>";
    }

    $conn->close();
}
?>

<div class="issue-book-container">
    <h2>Issue Book</h2>
    <form id="bookForm" method="POST" action="">
        <label for="bid">Issue ID:</label>
        <input type="text" id="bid" name="bid" required>

        <label for="studentId">Student ID:</label>
        <input type="text" id="studentId" name="studentId" required>

        <label for="bookId">Book ID:</label>
        <input type="text" id="bookId" name="bookId" required>

        <label for="issueDate">Issue Date:</label>
        <input type="date" id="issueDate" name="issueDate" required>

        <div class="btn-group">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>

<style>
    .issue-book-container h2 {
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
    }

    .issue-book-container form {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 10px;
        max-width: 400px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    .issue-book-container label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
        font-size: 14px;
    }

    .issue-book-container input[type="text"],
    .issue-book-container input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #aaa;
        border-radius: 5px;
        font-size: 14px;
    }

    .issue-book-container .btn-group {
        margin-top: 25px;
        display: flex;
        justify-content: center;
    }

    .issue-book-container button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        background-color: #27ae60;
        transition: background-color 0.3s ease;
    }

    .issue-book-container button:hover {
        background-color: #219150;
    }
</style>

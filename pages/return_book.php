<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['studentId'];
    $bookId = $_POST['bookId'];
    $returnDate = $_POST['returnDate'];

    // 1. Check if the book is issued to this student
    $checkIssuedQuery = "SELECT * FROM student_book WHERE SID = '$studentId' AND BID = '$bookId' AND ReturnDate IS NULL";
    $issuedResult = $conn->query($checkIssuedQuery);

    if ($issuedResult->num_rows > 0) {
        // 2. Update the ReturnDate in student_book table
        $updateReturnQuery = "UPDATE student_book
                              SET ReturnDate = '$returnDate'
                              WHERE SID = '$studentId' AND BID = '$bookId' AND ReturnDate IS NULL";

        if ($conn->query($updateReturnQuery) === TRUE) {
            // 3. Increase the count in book table
            $updateBookCount = "UPDATE book SET Count = Count + 1 WHERE BID = '$bookId'";
            $conn->query($updateBookCount);

            echo "<script>
                                alert('Book returned successfully!');
                                window.location.href='http://localhost/library/index.php?page=view_returned_books.php';
                            </script>";
        } else {
            echo "Error updating return: " . $conn->error;
        }
    } else {
        echo "<script>alert('No record found for this student and book!'); window.location.href='return_book.php';</script>";
    }

    $conn->close();
}
?>

<div class="return-book-container">
    <h2>Return Book</h2>
    <form id="bookForm" method="POST" action="">
        <label for="studentId">Student ID:</label>
        <input type="text" id="studentId" name="studentId" required>

        <label for="bookId">Book ID:</label>
        <input type="text" id="bookId" name="bookId" required>

        <label for="returnDate">Returned Date:</label>
        <input type="date" id="returnDate" name="returnDate" required>

        <div class="btn-group">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>

<style>
    .return-book-container h2 {
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
    }

    .return-book-container form {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 10px;
        max-width: 400px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    .return-book-container label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
        font-size: 14px;
    }

    .return-book-container input[type="text"],
    .return-book-container input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #aaa;
        border-radius: 5px;
        font-size: 14px;
    }

    .return-book-container .btn-group {
        margin-top: 25px;
        display: flex;
        justify-content: center;
    }

    .return-book-container button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        background-color: #27ae60;
        transition: background-color 0.3s ease;
    }

    .return-book-container button:hover {
        background-color: #219150;
    }
</style>

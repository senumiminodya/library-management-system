<?php
include 'connect.php';

// Check if IssueID is passed
if (isset($_GET['id'])) {
    $issueID = $_GET['id'];

    // Fetch current record
    $sql = "SELECT * FROM student_book WHERE IssueID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $issueID);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if (!$book) {
        echo "Returned book record not found!";
        exit;
    }
} else {
    echo "No Issue ID provided!";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['SID'];
    $bookID = $_POST['BID'];
    $returnDate = $_POST['ReturnDate'];

    $updateSql = "UPDATE student_book SET SID = ?, BID = ?, ReturnDate = ? WHERE IssueID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("iisi", $studentID, $bookID, $returnDate, $issueID);

    if ($updateStmt->execute()) {
        echo "<script>
                alert('Returned book record updated successfully!');
                window.location.href='http://localhost/library/index.php?page=view_returned_books.php';
              </script>";
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<h2>Edit Returned Book</h2>
<form method="post">
    <label for="SID">Student ID:</label>
    <input type="text" name="SID" id="SID" value="<?php echo htmlspecialchars($book['SID']); ?>" required>

    <label for="BID">Book ID:</label>
    <input type="text" name="BID" id="BID" value="<?php echo htmlspecialchars($book['BID']); ?>" required>

    <label for="ReturnDate">Return Date:</label>
    <input type="date" name="ReturnDate" id="ReturnDate" value="<?php echo htmlspecialchars($book['ReturnDate']); ?>" required>

    <button type="submit">Update Record</button>
</form>

<style>
    form {
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
    }

    button {
        margin-top: 15px;
        padding: 10px 15px;
        background-color: #2ecc71;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #27ae60;
    }
</style>

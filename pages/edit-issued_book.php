<?php
include 'connect.php';

// Check if IssueID is provided
if (isset($_GET['id'])) {
    $issueId = $_GET['id'];

    // Fetch existing data
    $sql = "SELECT * FROM student_book WHERE IssueID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $issueId);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if (!$book) {
        echo "Issued book not found.";
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sid = $_POST['SID'];
        $bid = $_POST['BID'];
        $issueDate = $_POST['IssueDate'];

        $updateSql = "UPDATE student_book SET SID = ?, BID = ?, IssueDate = ? WHERE IssueID = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("iisi", $sid, $bid, $issueDate, $issueId);

        if ($updateStmt->execute()) {
            echo "<script>
                    alert('Issued book updated successfully!');
                    window.location.href='http://localhost/library/index.php?page=view_issued_books.php';
                  </script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<h2>Edit Issued Book</h2>
<form method="POST">
    <label for="SID">Student ID:</label>
    <input type="number" name="SID" id="SID" value="<?php echo htmlspecialchars($book['SID']); ?>" required>

    <label for="BID">Book ID:</label>
    <input type="number" name="BID" id="BID" value="<?php echo htmlspecialchars($book['BID']); ?>" required>

    <label for="IssueDate">Issue Date:</label>
    <input type="date" name="IssueDate" id="IssueDate" value="<?php echo htmlspecialchars($book['IssueDate']); ?>" required>

    <button type="submit">Update</button>
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

<?php
include 'connect.php'; // ✅ Existing DB connection

// Fetch returned books from the database
$sql = "SELECT * FROM student_book";
$result = $conn->query($sql);
?>

<div class="view-return-book-container">
    <h2>View Returned Books</h2>
    <div class="table-wrapper">
        <table class="return-book-table">
            <thead>
                <tr>
                    <th>Issue ID</th>
                    <th>Student ID</th>
                    <th>Book ID</th>
                    <th>Returned Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['IssueID']); ?></td>
                            <td><?php echo htmlspecialchars($row['SID']); ?></td>
                            <td><?php echo htmlspecialchars($row['BID']); ?></td>
                            <td><?php echo htmlspecialchars($row['ReturnDate']); ?></td>
                            <td>
                                <a href="edit-returned_book.php?id=<?php echo $row['IssueID']; ?>" class="btn-edit">Edit</a>
                                <a href="delete-returned_book.php?id=<?php echo $row['IssueID']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this returned book?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No returned books found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .view-return-book-container {
        padding: 40px;
        max-width: 900px;
        margin: auto;
        font-family: Arial, sans-serif;
    }

    .view-return-book-container h2 {
        margin-bottom: 20px;
        font-size: 28px;
        color: #2c3e50;
    }

    .table-wrapper {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    .return-book-table {
        width: 100%;
        border-spacing: 0;
        background-color: #fff;
    }

    .return-book-table thead {
        display: table-header-group;
    }

    .return-book-table thead th {
        position: sticky;
        top: 0;
        background-color: #2c3e50;
        color: white;
        z-index: 2;
        text-align: left;
        padding: 12px 16px;
    }

    .return-book-table th,
    .return-book-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        background-color: white;
    }

    .return-book-table tr:hover {
        background-color: #f1f1f1;
    }

    .btn-edit,
    .btn-delete {
        padding: 6px 12px;
        margin-right: 5px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background-color: #f39c12;
    }

    .btn-edit:hover {
        background-color: #d68910;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }
</style>

<?php
$conn->close();
?>

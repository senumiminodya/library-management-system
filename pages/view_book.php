<?php
include 'connect.php'; // ✅ Use your existing connection

// Fetch books from the database
$sql = "SELECT * FROM book";
$result = $conn->query($sql);
?>

<div class="view-book-container">
    <h2>View Books</h2>
    <div class="table-wrapper"> <!-- Add this wrapper -->
        <table class="book-table">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['BID']); ?></td>
                            <td><?php echo htmlspecialchars($row['BName']); ?></td>
                            <td><?php echo htmlspecialchars($row['Author']); ?></td>
                            <td><?php echo htmlspecialchars($row['Count']); ?></td>
                            <td>
                                <a href="?page=edit-book.php&id=<?php echo $row['BID']; ?>" class="btn-edit">Edit</a>
                                <a href="?page=delete-book.php&id=<?php echo $row['BID']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No books found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<style>
    .table-wrapper {
        max-height: 400px; /* or any height you want */
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    /* Sticky Header Fix */
    .book-table thead {
        display: table-header-group;
    }

    .book-table thead th {
        position: sticky;
        top: 0;
        background-color: #2c3e50;
        color: white;
        z-index: 2;
    }

    .view-book-container {
        padding: 40px;
        max-width: 900px;
        margin: auto;
        font-family: Arial, sans-serif;
    }

    .view-book-container h2 {
        margin-bottom: 20px;
        font-size: 28px;
        color: #2c3e50;
    }

    .book-table {
        width: 100%;
        border-spacing: 0; /* Fix for spacing */
        background-color: #fff;
    }

    .book-table th,
    .book-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        background-color: white; /* Prevent overlapping */
    }

    .book-table tr:hover {
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

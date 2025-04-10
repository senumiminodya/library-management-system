<?php
include 'connect.php'; // ✅ Use your existing connection

// Fetch books from the database
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>
<div class="view-student-container">
    <h2>View Students</h2>
    <div class="table-wrapper"> <!-- Scrollable wrapper -->
        <table class="student-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['SID']); ?></td>
                            <td><?php echo htmlspecialchars($row['SName']); ?></td>
                            <td><?php echo htmlspecialchars($row['Grade']); ?></td>
                            <td>
                                <a href="edit-student.php?id=<?php echo $row['SID']; ?>" class="btn-edit">Edit</a>
                                <a href="delete-student.php?id=<?php echo $row['SID']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No students found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .view-student-container {
        padding: 40px;
        max-width: 900px;
        margin: auto;
        font-family: Arial, sans-serif;
    }

    .view-student-container h2 {
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

    .student-table {
        width: 100%;
        border-spacing: 0;
        background-color: #fff;
    }

    .student-table thead {
        display: table-header-group;
    }

    .student-table thead th {
        position: sticky;
        top: 0;
        background-color: #2c3e50;
        color: white;
        z-index: 2;
    }

    .student-table th,
    .student-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        background-color: white;
    }

    .student-table tr:hover {
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

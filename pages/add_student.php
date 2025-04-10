<?php
include 'connect.php'; // DB connection

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = trim($_POST['sid']);
    $studentName = trim($_POST['studentName']);
    $grade = (int) trim($_POST['grade']);

    $stmt = $conn->prepare("INSERT INTO student (SID, SName, Grade) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $studentId, $studentName, $grade);

    if ($stmt->execute()) {
            // Set message and use header for redirection
            $message = "Student added successfully!";
            header("Location: index.php?page=view_student.php&message=" . urlencode($message));
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
<div class="add-student-container">
    <h2>Add New Student</h2>
    <form id="studentForm" method="POST" action="">
        <label for="sid">Student ID:</label>
        <input type="text" id="sid" name="sid" required>

        <label for="studentName">Student Name:</label>
        <input type="text" id="studentName" name="studentName" required>

        <label for="grade">Choose a Grade:</label>
        <select name="grade" id="grade">
            <option value="6">Grade 6</option>
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
            <option value="10">Grade 10</option>
            <option value="11">Grade 11</option>
            <option value="12">Grade 12</option>
        </select>

        <div class="btn-group">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>

<style>
    .add-student-container h2 {
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
    }

    .add-student-container form {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 10px;
        max-width: 400px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    .add-student-container label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
        font-size: 14px;
    }

    .add-student-container input[type="text"],
    .add-student-container select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #aaa;
        border-radius: 5px;
        font-size: 14px;
    }

    .add-student-container select {
        background-color: #fff;
        color: #333;
    }

    .add-student-container .btn-group {
        margin-top: 25px;
        display: flex;
        justify-content: space-between;
    }

    .add-student-container button {
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

    .add-student-container .btn-submit {
        background-color: #27ae60;
    }

    .add-student-container .btn-submit:hover {
        background-color: #219150;
    }

    .add-student-container .btn-update {
        background-color: #f39c12;
    }

    .add-student-container .btn-update:hover {
        background-color: #d68910;
    }

    .add-student-container .btn-delete {
        background-color: #e74c3c;
    }

    .add-student-container .btn-delete:hover {
        background-color: #c0392b;
    }
</style>

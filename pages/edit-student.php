<?php
include 'connect.php';

// Check if the student ID is passed
if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Fetch student details
    $sql = "SELECT * FROM student WHERE SID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
} else {
    echo "No student ID provided!";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST['student_name'];
    $grade = $_POST['grade'];

    $updateSql = "UPDATE student SET SName = ?, Grade = ? WHERE SID = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssi", $studentName, $grade, $studentId);

    if ($stmt->execute()) {
        echo "<script>
                    alert('Student updated successfully!');
                    window.location.href='http://localhost/library/index.php?page=view_student.php';
                </script>";
    } else {
        echo "Error updating student: " . $conn->error;
    }
}
?>

<h2>Edit Student</h2>
<form method="post">
    <label for="student_name">Student Name:</label>
    <input type="text" name="student_name" id="student_name" value="<?php echo htmlspecialchars($student['SName']); ?>" required>

    <label for="grade">Grade:</label>
    <input type="text" name="grade" id="grade" value="<?php echo htmlspecialchars($student['Grade']); ?>" required>

    <button type="submit">Update Student</button>
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

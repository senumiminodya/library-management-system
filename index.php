<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get the requested page and title from URL
$page = isset($_GET['page']) ? $_GET['page'] : null;

// Page titles for display
$pageTitles = [
    'add_book.php' => 'Add Book',
    'view_book.php' => 'View Book',
    'add_student.php' => 'Add Student',
    'view_student.php' => 'View Student',
    'issue_book.php' => 'Issue Book',
    'view_issued_books.php' => 'View Issued Books',
    'return_book.php' => 'Return Book',
    'view_returned_books.php' => 'View Returned Books'
];

// Set the page title
$pageTitle = isset($pageTitles[$page]) ? $pageTitles[$page] : 'Library Management System';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <style>
        /* Same your CSS styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            height: 100vh;
            font-family: Arial, sans-serif;
            background: url('assets/dashboard_img.jpg') no-repeat center center;
            background-size: cover;
        }

        .sidebar {
            width: 300px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background-color: rgba(140, 84, 29, 0.6);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
        }

        .sidebar a {
            background-color: #d8c4bb;
            color: #262727;
            text-decoration: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            transition: 0.3s;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: #af3e46;
            color: #d8c4bb;
        }

        .content {
            flex: 1;
            padding: 30px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
            text-shadow: 1px 1px 2px black;
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
        }

        #dynamicContent {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 10px;
            min-height: 300px;
            width: fit-content;
            max-width: 90%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="?page=add_book.php">Add Book</a>
    <a href="?page=view_book.php">View Book</a>
    <a href="?page=add_student.php">Add Student</a>
    <a href="?page=view_student.php">View Student</a>
    <a href="?page=issue_book.php">Issue Book</a>
    <a href="?page=view_issued_books.php">View Issued Books</a>
    <a href="?page=return_book.php">Return Book</a>
    <a href="?page=view_returned_books.php">View Returned Books</a>
    <a href="login.php">Log out</a>
</div>

<div class="content">
    <div class="page-title"><?php echo htmlspecialchars($pageTitle); ?></div>
    <div id="dynamicContent">
        <?php
        if ($page && file_exists(__DIR__ . '/pages/' . $page)) {
            include __DIR__ . '/pages/' . $page;
        } else {
            ?>
            <h3>Welcome to the Library Management System!</h3><br><br>
            <p>Use the menu on the left to navigate through the various functionalities:</p>
            <ul style="list-style-type: disc; line-height: 1.6;">
                <li>Add new books</li>
                <li>Add new students</li>
                <li>View existing records (books and students)</li>
                <li>Manage book issues</li>
                <li>Manage book returns</li>
                <li>Keep track of all library transactions</li>
            </ul><br><br>
            <h4 style="color: red; ">Select an option to get started.</h4>
            <?php
        }
        ?>
    </div>
</div>

</body>
</html>

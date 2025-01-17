<?php
// Start the session
session_start();

// Database configuration
$host = 'localhost';
$db = 'Alumni_Database';
$user = 'root';
$pass = '12345';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user account details from the 'users' table
$stmt = $pdo->prepare("SELECT username, email, password FROM users WHERE username = :username");
$stmt->execute(['username' => $_SESSION['username']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    // Handle logout (destroy session, redirect to login page)
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #006400;
            padding: 10px 20px;
        }
        nav img {
            max-height: 50px;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 10px;
            background-color: #006400;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #004d00;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <img src="images/plmun-logo.png" alt="School Logo">
        </div>
        <div>
            <a href="landing.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_account.php">Account</a>
        </div>
    </nav>

    <div class="container">
        <h1>Manage Account</h1>
        <?php if ($user): ?>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td><?= htmlspecialchars($user['username']); ?></td>
                    <td><?= htmlspecialchars($user['email']); ?></td>
                    <td><?= htmlspecialchars($user['password']); ?></td>
                    <td>
                        <form action="edit_account.php" method="get" style="display:inline;">
                            <button type="submit">Edit Account</button>
                        </form>
                        <form action="delete_account.php" method="post" style="display:inline;">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this account?');">Delete Account</button>
                        </form>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <p>No account found. Please log in.</p>
        <?php endif; ?>

        <form action="" method="post">
            <button type="submit" name="logout">Log Out</button>
        </form>
    </div>

</body>
</html>
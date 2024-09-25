<?php
session_start(); // Start the session

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = "localhost"; // Your database host
$dbname = "Alumni_Database"; // Your database name
$username = "root"; // Your database username
$password = "12345"; // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception to catch errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Initialize error variable
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the POST request
    $submitted_username = $_POST['username'];
    $submitted_password = $_POST['password'];

    // Query to fetch the user from the database
    $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $submitted_username);
    $stmt->execute();
    
    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Check if the password matches (assuming passwords are stored hashed in the DB)
        if (password_verify($submitted_password, $user['password'])) {
            // Set session variables if the password is correct
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];

            // Redirect to the landing page
            header("Location: landing.php");
            exit();
        } else {
            // Invalid password
            $error = 'Invalid username or password.';
        }
    } else {
        // Username not found
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/bgimage.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-position: center;
        }
        .login-container {
            background-color: rgba(0, 77, 0, 0.9); /* Dark green with slight transparency */
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            color: white; /* White text */
            width: 300px; /* Fixed width */
            text-align: center; /* Centered text */
        }
        .logo {
            width: 250px; /* Set your logo width */
            margin-bottom: 1rem; /* Space below the logo */
        }
        h2 {
            margin-bottom: 1rem; /* Space below the header */
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
        }
        input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
        }
        button {
            background-color: #ffffff; /* White button */
            color: #004d00; /* Dark green text */
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #cce5cc; /* Light green on hover */
        }
        .error {
            color: #ffcc00; /* Yellow for error messages */
            background-color: rgba(255, 0, 0, 0.3); /* Semi-transparent background for the error */
            padding: 0.5rem; /* Padding for better appearance */
            border-radius: 5px; /* Rounded corners */
            margin-bottom: 1rem; /* Space below the error message */
            width: 100%; /* Full width to fit the container */
            text-align: center; /* Centered text */
        }
        .signup-button {
            background-color: #cce5cc; /* Light green */
            color: #004d00; /* Dark green text */
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 3px;
            display: inline-block;
            margin-top: 1rem;
        }
        .signup-button:hover {
            background-color: #99cc99; /* Darker light green on hover */
        }
    </style>
</head>
<body>
<div class="login-container">
        <img src="images/plmun-logo.png" alt="School Logo" class="logo">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p> <!-- Display error message -->
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php" class="signup-button">Sign Up</a></p>
    </div>
</body>
</html>


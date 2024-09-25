<?php
session_start();
// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
include 'db.php';

// Handle file submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES['file'];

    // Validate the uploaded file (you can add more validation as needed)
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];

        // Move the uploaded file to a desired directory (make sure this directory exists)
        $uploadFileDir = './uploaded_files/';
        $destPath = $uploadFileDir . $fileName;

        if(move_uploaded_file($fileTmpPath, $destPath)) {
            // Store the file data in the database if needed (example)
            $sql = "INSERT INTO files (file_name, file_path) VALUES ('$fileName', '$destPath')";
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded and data stored successfully.";
            } else {
                echo "Error storing data: " . $conn->error;
            }
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "File upload error.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Conversion</title>
    <style>
        /* Similar styles to add_alumni.php */
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
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: #006400;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #005000;
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

    <!-- Main Content Area -->
    <div class="container">
        <h2>File Conversion</h2>
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="file">Select File to Upload:</label>
            <input type="file" name="file" required>

            <input type="submit" value="Upload File">
        </form>
    </div>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
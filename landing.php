<?php
session_start();
// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Light background for contrast */
        }
        /* Navigation Bar */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #006400; /* Dark Green Color */
            padding: 10px 20px;
        }
        nav .logo {
            flex: 1;
        }
        nav img {
            max-height: 50px; /* Adjust as necessary */
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
        /* Main Content */
        .main-content {
            text-align: center;
            padding: 20px;
            background-color: #FFDA03;
            height: auto; /* Change to auto to allow content to expand */
        }
        h2 {
            margin: 20px 0;
            font-size: 45px;
        }
        /* Gallery Styles */
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .gallery-item {
            margin: 15px;
            text-align: center;
        }
        .gallery-item img {
            width: 100px; /* Set width for icons */
            height: 100px; /* Set height for icons */
        }
        .divider {                /* minor cosmetics */
            display: table; 
            font-size: 24px; 
            text-align: center; 
            width: 75%;             /* divider width */
            margin: 10px auto;          /* spacing above/below */
        }
        /* Philosophy Styles */
        .philosophy {
            display: flex; /* Use flexbox to arrange items in a row */
            justify-content: space-around; /* Space items evenly */
            margin: 20px 0;
            text-align: left; /* Align text to the left */
            max-width: 1000px; /* Limit width for better readability */
            margin-left: auto;
            margin-right: auto; /* Center align the section */
        }
        .philosophy-item {
            flex: 1; /* Each item takes equal space */
            margin: 0 25px; /* Space between items */
        }
        .philosophy h3 {
            font-size: 30px; /* Heading size */
            margin-bottom: 10px; /* Space below heading */
            font-weight: normal; /* Make the heading font not bold */
        }
        .philosophy p {
            font-size: 18px; /* Paragraph size */
            line-height: 1.6; /* Space between lines */
            margin-bottom: 15px; /* Space below paragraphs */
            font-weight: normal; /* Make the paragraph font not bold */
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <img src="images/plmun-logo.png" alt="School Logo"> <!-- Replace with your actual logo path -->
        </div>
        <div>
            <a href="landing.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_account.php">Account</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content">
        <h2>COLLEGES</h2>
        
        <!-- Gallery of College Icons -->
        <div class="gallery">
            <div class="gallery-item">
                <img src="images/cas-logo.png" alt="cas logo"> <!-- Replace with actual icon path -->
                <p>College of Arts & Sciences</p>
            </div>
            <div class="gallery-item">
                <img src="images/cba-logo.png" alt="cba logo"> <!-- Replace with actual icon path -->
                <p>College of Business Administration</p>
            </div>
            <div class="gallery-item">
                <img src="images/ccj-logo.png" alt="ccj logo"> <!-- Replace with actual icon path -->
                <p>College of Criminal Justice</p>
            </div>
            <div class="gallery-item">
                <img src="images/citcs-logo.png" alt="citcs logo"> <!-- Replace with actual icon path -->
                <p>College of Computer Studies</p>
            </div>
            <div class="gallery-item">
                <img src="images/cte-logo.png" alt="cte logo"> <!-- Replace with actual icon path -->
                <p>College of Teacher Education</p>
            </div>
        </div>

        <h2>EDUCATIONAL PHILOSOPHY</h2>
        <div class="philosophy">
            <div class="philosophy-item">
                <h3>Mission</h3>
                <p>To provide quality, affordable and relevant education responsive to the changing needs of the local and global communities through effective and efficient integration of instruction, research and extension; to develop productive and God-loving individuals in society.</p>
            </div>
            <div class="philosophy-item">
                <h3>Vision</h3>
                <p>A dynamic and highly competitive Higher Education Institution (HEI) committed to people empowerment towards building a humane society.</p>
            </div>
            <div class="philosophy-item">
                <h3>Quality Policy</h3>
                <p>“We, in the Pamantasan ng Lungsod ng Muntinlupa, commit to meet and even exceed our clients’ needs and expectations by adhering to good governance, productivity and continually improving the effectiveness of our Quality Management System in compliance to ethical standards and applicable statutory and regulatory requirements.”</p>
            </div>
        </div>
    </div>

</body>
</html>


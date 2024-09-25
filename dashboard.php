<?php
session_start();
// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
include 'db.php';

// Handle filter submission
$collegeFilter = isset($_POST['college']) ? $_POST['college'] : '';
$departmentFilter = isset($_POST['department']) ? $_POST['department'] : '';
$sectionFilter = isset($_POST['section']) ? $_POST['section'] : '';

// Query to join the two tables and fetch the necessary data
$query = "SELECT 
            a.student_id, 
            a.last_name AS student_last_name, 
            a.first_name AS student_first_name, 
            a.college, 
            a.department, 
            a.section, 
            a.year_graduated, 
            a.contact_number, 
            a.personal_email, 
            w.alumni_id, 
            w.last_name AS alumni_last_name, 
            w.first_name AS alumni_first_name, 
            w.department AS alumni_department, 
            w.year_graduated AS alumni_year_graduated, 
            w.contact_no, 
            w.personal_email AS alumni_email, 
            w.working_status 
          FROM 
            `2024-2025` a 
          LEFT JOIN 
            `2024-2025-ws` w 
          ON 
            a.student_id = w.alumni_id"; // Assuming alumni_id corresponds to student_id

// Add filtering to the query
$conditions = [];
if (!empty($collegeFilter)) {
    $conditions[] = "a.college = '$collegeFilter'";
}
if (!empty($departmentFilter)) {
    $conditions[] = "a.department = '$departmentFilter'";
}
if (!empty($sectionFilter)) {
    $conditions[] = "a.section = '$sectionFilter'";
}

if (count($conditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$result = $conn->query($query);

// Fetch departments and sections based on selected college
$departments = [
    'CAS' => ['PSYCHOLOGY', 'MASCOM'],
    'CBA' => ['HRM', 'MARKETING', 'OPERATIONS MANAGEMENT'],
    'CCJ' => ['CRIMINOLOGY'],
    'CTE' => ['ELEMENTARY EDUCATION', 'SECONDARY EDUCATION'],
    'CITCS' => ['COMPUTER SCIENCE', 'INFORMATION TECHNOLOGY', 'ACT']
];

// Get unique sections from the database
$sectionsQuery = "SELECT DISTINCT section FROM `2024-2025`";
$sectionsResult = $conn->query($sectionsQuery);
$sections = [];
while ($row = $sectionsResult->fetch_assoc()) {
    $sections[] = $row['section'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMNI DASHBOARD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Light background for contrast */
        
        }
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #006400; /* Dark Green Color */
            padding: 10px 20px;
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
        .container {
            padding: 20px;
        }
        h2 {
            text-align: center; /* Center the header */
            font-size: 35px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #006400; /* Dark Green Color for Header */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Light grey for even rows */
        }
        .filter-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .filter-container select {
            margin: 0 10px;
            padding: 5px;
        }
    </style>
</head>
<<body>

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
<div class="container">
    <h2>S.Y 2024-2025 ALUMNI LIST</h2>
    
    <!-- Filter Section -->
    <div class="filter-container">
        <form method="POST" action="">
            <select name="college" id="college" onchange="updateDepartmentOptions()">
                <option value="">Select College</option>
                <option value="CAS" <?= $collegeFilter == 'CAS' ? 'selected' : '' ?>>CAS</option>
                <option value="CBA" <?= $collegeFilter == 'CBA' ? 'selected' : '' ?>>CBA</option>
                <option value="CCJ" <?= $collegeFilter == 'CCJ' ? 'selected' : '' ?>>CCJ</option>
                <option value="CTE" <?= $collegeFilter == 'CTE' ? 'selected' : '' ?>>CTE</option>
                <option value="CITCS" <?= $collegeFilter == 'CITCS' ? 'selected' : '' ?>>CITCS</option>
            </select>

            <select name="department" id="department" onchange="updateSectionOptions()">
                <option value="">Select Department</option>
                <?php if ($collegeFilter): ?>
                    <?php foreach ($departments[$collegeFilter] as $department): ?>
                        <option value="<?= $department ?>" <?= $departmentFilter == $department ? 'selected' : '' ?>><?= $department ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <select name="section" id="section">
                <option value="">Select Section</option>
                <?php foreach ($sections as $section): ?>
                    <option value="<?= $section ?>" <?= $sectionFilter == $section ? 'selected' : '' ?>><?= $section ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>


<!-- Add New Alumni Button -->
<div style="text-align: center; margin-bottom: 20px;">
    <a href="add_alumni.php" style="padding: 10px 20px; background-color: #006400; color: white; text-decoration: none; font-weight: bold; border-radius: 5px;">Add New Alumni</a>
</div> 
<div style="text-align: center; margin-bottom: 20px;">
    <a href="file_conversion.php" style="padding: 10px 20px; background-color: #006400; color: white; text-decoration: none; font-weight: bold; border-radius: 5px;">Add File</a>
</div>


    <!-- Displaying the joint table data -->
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Alumni ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>College</th>
                <th>Department</th>
                <th>Section</th>
                <th>Year Graduated</th>
                <th>Contact Number</th>
                <th>Personal Email</th>
                <th>Working Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    // Handle NULL values using ?? operator, fallback to empty string if NULL
                    echo "<tr>
                            <td>" . ($row['student_id'] ?? '') . "</td>
                            <td>" . ($row['alumni_id'] ?? '') . "</td>
                            <td>" . ($row['student_last_name'] ?? '') . "</td>
                            <td>" . ($row['student_first_name'] ?? '') . "</td>
                            <td>" . ($row['college'] ?? '') . "</td>
                            <td>" . ($row['department'] ?? '') . "</td>
                            <td>" . ($row['section'] ?? '') . "</td>
                            <td>" . ($row['year_graduated'] ?? '') . "</td>
                            <td>" . ($row['contact_number'] ?? '') . "</td>
                            <td>" . ($row['personal_email'] ?? '') . "</td>
                            <td>" . ($row['working_status'] ?? '') . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function updateDepartmentOptions() {
        const collegeSelect = document.getElementById('college');
        const departmentSelect = document.getElementById('department');

        // Clear previous department options
        departmentSelect.innerHTML = '<option value="">Select Department</option>';

        // Get selected college
        const selectedCollege = collegeSelect.value;

        // Define department options based on college selection
        const departments = {
            'CAS': ['PSYCHOLOGY', 'MASCOM'],
            'CBA': ['HRM', 'MARKETING', 'OPERATIONS MANAGEMENT'],
            'CCJ': ['CRIMINOLOGY'],
            'CTE': ['ELEMENTARY EDUCATION', 'SECONDARY EDUCATION'],
            'CITCS': ['COMPUTER SCIENCE', 'INFORMATION TECHNOLOGY', 'ACT']
        };

        // Populate department options
        if (selectedCollege && departments[selectedCollege]) {
            departments[selectedCollege].forEach(department => {
                departmentSelect.innerHTML += `<option value="${department}">${department}</option>`;
            });
        }
    }

    function updateSectionOptions() {
        // This function can be implemented similarly if section filtering is dependent on the first two dropdowns.
    }
</script>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>

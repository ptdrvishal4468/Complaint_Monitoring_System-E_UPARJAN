<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

// Fetch complaints from the database
$sql = "SELECT * FROM complaints";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        h2 {
            color: #00796b;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #00796b;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .button {
            background: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Complaint Management - Admin Dashboard</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Description</th>
                <th>Center Code</th>
                <th>Complaint Date</th>
                <th>Uploaded File</th>
                <th>Status</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['idcomplaints'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['mobile_number'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['center_code'] . "</td>";
                    echo "<td>" . $row['complaint_date'] . "</td>";
                    echo "<td><a href='" . $row['uploaded_file'] . "'>View File</a></td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['remark'] . "</td>";
                    echo "<td><a href='update_complaint.php?id=" . $row['idcomplaints'] . "' class='button'>Update</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No complaints found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>

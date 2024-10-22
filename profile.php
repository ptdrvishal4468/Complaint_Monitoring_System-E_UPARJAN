<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mobile_number'])) {
    $mobile_number = $conn->real_escape_string($_POST['mobile_number']);

    // Fetch complaints based on mobile number
    $sql_complaints = "SELECT * FROM complaints WHERE mobile_number='$mobile_number'";
    $complaints_result = $conn->query($sql_complaints);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Farmer Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 600px;
        }
        h2 {
            color: #00796b;
            margin-bottom: 20px;
        }
        label {
            margin-bottom: 5px;
            display: block;
            color: #333333;
        }
        input[type="tel"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .error {
            color: #ff0000;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>View Complaints</h2>
        <form action="profile.php" method="POST">
            <label for="mobile_number">Mobile Number:</label>
            <input type="tel" id="mobile_number" name="mobile_number" required>
            <input type="submit" value="Verify Mobile Number">
        </form>

        <?php if (isset($complaints_result)) { ?>
            <h2>My Complaints</h2>
            <?php if ($complaints_result->num_rows > 0) { ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                    <?php while ($row = $complaints_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['idcomplaints']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['complaint_date']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p>No complaints found.</p>
            <?php } ?>
        <?php } ?>
    </div>
</body>
</html>

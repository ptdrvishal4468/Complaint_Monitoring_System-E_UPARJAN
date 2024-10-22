<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $complaint_id = $_GET['id'];

    // Fetch complaint details
    $sql = "SELECT * FROM complaints WHERE idcomplaints='$complaint_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $complaint = $result->fetch_assoc();
    } else {
        echo "No complaint found with this ID.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $complaint_id = $_POST['id'];
    $status = $conn->real_escape_string($_POST['status']);
    $remark = $conn->real_escape_string($_POST['remark']);
    $disposal_date = $conn->real_escape_string($_POST['disposal_date']);

    // Update complaint status, remark, and disposal date
    $sql = "UPDATE complaints SET status='$status', remark='$remark', disposal_date='$disposal_date' WHERE idcomplaints='$complaint_id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: admin_dashboard.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Complaint</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #00796b;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 14px 0;
        }
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .navbar li {
            display: inline;
            margin-right: 20px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            margin: 100px auto 20px auto;
        }
        h2 {
            color: #00796b;
            margin-bottom: 20px;
            text-align: center;
        }
        
        label {
            margin-bottom: 5px;
            display: block;
            color: #333333;
        }
        input[type="text"], textarea, select, input[type="date"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
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
    </style>
</head>
<body>
    
    <div class="container">
        <h2>Update Complaint</h2>
        <form action="update_complaint.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $complaint['idcomplaints']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $complaint['name']; ?>" readonly>

            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $complaint['mobile_number']; ?>" readonly>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" readonly><?php echo $complaint['description']; ?></textarea>

            <label for="center_code">Center Code:</label>
            <input type="text" id="center_code" name="center_code" value="<?php echo $complaint['center_code']; ?>" readonly>

            <label for="complaint_date">Complaint Date:</label>
            <input type="text" id="complaint_date" name="complaint_date" value="<?php echo $complaint['complaint_date']; ?>" readonly>

            <label for="uploaded_file">Uploaded File:</label>
            <a href="<?php echo $complaint['uploaded_file']; ?>">View File</a>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Pending" <?php echo ($complaint['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="Resolved" <?php echo ($complaint['status'] == 'Resolved') ? 'selected' : ''; ?>>Resolved</option>
            </select>

            <label for="remark">Remark:</label>
            <textarea id="remark" name="remark" rows="4"><?php echo $complaint['remark']; ?></textarea>

            <label for="disposal_date">Disposal Date:</label>
            <input type="date" id="disposal_date" name="disposal_date" value="<?php echo $complaint['disposal_date']; ?>">

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>

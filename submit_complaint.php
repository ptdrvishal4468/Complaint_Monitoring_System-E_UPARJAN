<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $mobile_number = $conn->real_escape_string($_POST['mobile_number']);
    $description = $conn->real_escape_string($_POST['description']);
    $center_code = $conn->real_escape_string($_POST['center_code']);
    $complaint_date = $conn->real_escape_string($_POST['complaint_date']);

    // File upload handling
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Ensure the directory exists
    }
    $target_file = $target_dir . basename($_FILES["uploaded_file"]["name"]);
    $uploadOk = 1;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["uploaded_file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_types = array("jpg", "jpeg", "png", "pdf", "doc", "docx");
    if (!in_array($file_type, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG, PDF, DOC & DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES["uploaded_file"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $sql = "INSERT INTO complaints (name, mobile_number, description, center_code, complaint_date, uploaded_file)
            VALUES ('$name', '$mobile_number', '$description', '$center_code', '$complaint_date', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        header('Location: update_response.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Complaint</title>
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
        input[type="text"], input[type="tel"], input[type="date"], textarea, input[type="file"] {
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
        .error {
            color: #ff0000;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Submit a Complaint</h2>
        <form action="submit_complaint.php" method="POST" enctype="multipart/form-data">
            <label for="name">Name (नाम):</label>
            <input type="text" id="name" name="name" required>

            <label for="mobile_number">Mobile Number (मोबाइल नंबर):</label>
            <input type="tel" id="mobile_number" name="mobile_number" required>

            <label for="description">Complaint Description (शिकायत विवरण):</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="center_code">Center Code (केंद्र कोड):</label>
            <input type="text" id="center_code" name="center_code" required>

           
            <label for="complaint_date">Complaint Date (शिकायत की तारीख):</label>
            <input type="date" id="complaint_date" name="complaint_date" required>

            <label for="uploaded_file">Upload File (फ़ाइल अपलोड करें):</label>
            <input type="file" id="uploaded_file" name="uploaded_file" required>

            <input type="submit" value="Submit (सबमिट)">
        </form>
    </div>
</body>
</html>

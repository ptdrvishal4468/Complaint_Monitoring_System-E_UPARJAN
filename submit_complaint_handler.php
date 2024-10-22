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

    $sql = "INSERT INTO complaints (name, mobile_number, description, center_code, date_of_application, complaint_date, uploaded_file)
            VALUES ('$name', '$mobile_number', '$description', '$center_code', '$complaint_date', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        header('Location: response.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

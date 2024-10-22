<!DOCTYPE html>
<html>
<head>
    <title>Complaint Submitted</title>
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
            max-width: 400px;
        }
        h2 {
            color: #00796b;
        }
        p {
            color: #004d40;
            margin-bottom: 20px;
        }
        .positive-message {
            background: #c8e6c9;
            padding: 10px;
            border-radius: 5px;
            color: #388e3c;
            margin-bottom: 20px;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Adding gap for spacing */
            align-items: center;
        }
        .button {
            text-decoration: none;
            color: #ffffff;
            background: #00796b;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .button:hover {
            background: #004d40;
        }
        @media (min-width: 600px) {
            .button-container {
                flex-direction: row;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Complaint Submitted Successfully</h2>
        <p class="positive-message">Your complaint has been successfully submitted. Thank you for bringing this issue to our attention.</p>
        <div class="button-container">
            <a href="view_complaints.php" class="button">Check Other Complaints</a>
            <a href="submit_complaint.php" class="button">Submit Another Complaint</a>
        </div>
    </div>
</body>
</html>

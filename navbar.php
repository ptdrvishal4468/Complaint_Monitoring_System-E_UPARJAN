<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <?php
            session_start();
            if (isset($_SESSION['mobile_number'])) {
                echo '<li><a href="farmer_dashboard.php">Farmer Dashboard</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            } elseif (isset($_SESSION['username'])) {
                echo '<li><a href="admin_dashboard.php">Admin Dashboard</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="profile.php">Farmer Login</a></li>';
                echo '<li><a href="login.php">Admin Login</a></li>';
                echo '<li><a href="register.php">Register Admin</a></li>';
            }
            ?>
        </ul>
    </nav>
</body>
</html>

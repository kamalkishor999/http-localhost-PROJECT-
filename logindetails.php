<?php
session_start();

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "formdata";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$userDetails = null;
$stmt = $conn->prepare("SELECT first_name, last_name, dob, address, phone FROM data WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $userDetails = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .profile-header {
            background-color: #4267B2;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .user-details {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .list-group-item {
            border: none;
            padding: 10px 15px;
        }
        .btn {
            width: 150px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <h2>Welcome to Your Profile</h2>
            <p>Logged in as: <?php echo htmlspecialchars($email); ?></p>
        </div>
        
        <?php if ($userDetails): ?>
            <div class="user-details">
                <h5>User Details:</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>First Name:</strong> <?php echo htmlspecialchars($userDetails['first_name']); ?></li>
                    <li class="list-group-item"><strong>Last Name:</strong> <?php echo htmlspecialchars($userDetails['last_name']); ?></li>
                    <li class="list-group-item"><strong>Date of Birth:</strong> <?php echo htmlspecialchars($userDetails['dob']); ?></li>
                    <li class="list-group-item"><strong>Address:</strong> <?php echo htmlspecialchars($userDetails['address']); ?></li>
                    <li class="list-group-item"><strong>Phone:</strong> <?php echo htmlspecialchars($userDetails['phone']); ?></li>
                </ul>
            </div>
        <?php else: ?>
            <p>No user details available.</p>
        <?php endif; ?>
        
        <form method="POST" class="text-center mt-4">
            <a href="./edit.php" class="btn btn-primary">Edit Profile</a>
            <a href="./newpassword.php" class="btn btn-secondary">Change Password</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

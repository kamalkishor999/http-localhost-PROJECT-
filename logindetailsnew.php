<?php
session_start();

if (!isset($_SESSION['submit']) || $_SESSION['submit'] !== true) {
    header('Location: login.php'); 
    exit;
}

$email = $_SESSION['email'];

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT first_name, last_name, phone, address, dob FROM data WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$userDetails = $result->fetch_assoc();

$stmt->close();
$conn->close();

$firstName = htmlspecialchars($userDetails['first_name'] ?? '');
$lastName = htmlspecialchars($userDetails['last_name'] ?? '');
$phone = htmlspecialchars($userDetails['phone'] ?? '');
$address = htmlspecialchars($userDetails['address'] ?? '');
$dob = htmlspecialchars($userDetails['dob'] ?? '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: white;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <h2 class="text-center">User Dashboard</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h5>Personal Information</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>First Name:</strong> <?php echo $firstName; ?></li>
                    <li class="list-group-item"><strong>Last Name:</strong> <?php echo $lastName; ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?php echo $email; ?></li>
                    <li class="list-group-item"><strong>Phone:</strong> <?php echo $phone; ?></li>
                    <li class="list-group-item"><strong>Address:</strong> <?php echo $address; ?></li>
                    <li class="list-group-item"><strong>Date of Birth:</strong> <?php echo $dob; ?></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
session_start();
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "formdata";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$emailErr = $oldPassErr = $newPassErr = "";
$isValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = $_SESSION['email']; // Get logged-in user's email
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Validate old password
    $stmt = $conn->prepare("SELECT password FROM data WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($storedPassword);
        $stmt->fetch();

        if ($oldPassword !== $storedPassword) {
            $oldPassErr = "Invalid old password.";
            $isValid = false;
        }
    } else {
        $emailErr = "Email not registered.";
        $isValid = false;
    }
    $stmt->close();

    // If old password is valid, update the new password
    if ($isValid) {
        $stmt = $conn->prepare("UPDATE data SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Password changed successfully!'); window.location.href='login.php';</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Change Password</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="old_password">Old Password:</label>
                    <input type="password" class="form-control" id="old_password" name="old_password" required>
                    <span class="error"><?php echo $oldPassErr; ?></span>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <span class="error"><?php echo $newPassErr; ?></span>
                </div>

                <div class="text-center">
                    <input type="submit" name="submit" value="Change Password" class="btn btn-primary btn-block">
                </div>
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-secondary btn-block">Back</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

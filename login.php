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

$emailErr = $passErr = "";
$isValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "(Only Valid Email)";
        $isValid = false;
    }

    if (empty($password)) {
        $passErr = "(Password is required)";
        $isValid = false;
    }

    if ($isValid) {
        $stmt = $conn->prepare("SELECT password FROM data WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($storedPassword);
            $stmt->fetch();

            if ($password === $storedPassword) {
                $_SESSION['email'] = $email; 
                header("Location: logindetails.php"); 
                exit;
            } else {
                $passErr = "(Invalid password)";
            }
        } else {
            $emailErr = "(Email not registered)";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <style>
        .error { color: red; }
        .contai {
            background-image: url(./back.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            width: 100%;
            max-width: 400px; 
            padding: 20px; 
        }
    </style>
</head>
<body>
    <div class="contai">
        <div class="form-container">
            <h2 class="text-center text-darkslategray mb-4">Login Form</h2>
            <form method="POST" class="bg-light p-4 rounded shadow">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="xyz@gmail.com" required>
                    <span class="error"><?php echo $emailErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    <span class="error"><?php echo $passErr; ?></span>
                </div>
                <div class="text-center">
                    <input type="submit" name="submit" value="Login" class="btn btn-primary">
                    <a href="contact.php" class="btn btn-primary">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

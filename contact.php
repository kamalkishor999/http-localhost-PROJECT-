<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "formdata";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$emerr = $passerr = $fnerr = $lnerr = $phoneerr = $doberr = "";
$isValid = true;
$showAlert = false; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $address = trim($_POST['address']);
    $dob = $_POST['dob'];

    if (empty($firstName) || !preg_match("/^[a-zA-Z]{4,}$/", $firstName)) {
        $fnerr = "* (Must be minimum 4 alphabets)";
        $isValid = false;
    }

    if (empty($lastName) || !preg_match("/^[a-zA-Z]{4,}$/", $lastName)) {
        $lnerr = "* (Must be minimum 4 alphabets)";
        $isValid = false;
    }

    if (empty($phone) || !preg_match("/^\d{10}$/", $phone)) {
        $phoneerr = "* (Must be 10 digits, Only numbers)";
        $isValid = false;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emerr = "* (Only Valid Email)";
        $isValid = false;
    }

    if (empty($password) || !preg_match("/^[a-zA-Z]{6,}$/", $password)) {
        $passerr = "* (String Password only)";
        $isValid = false;
    }

    if (empty($dob)) {
        $doberr = "* (Date of Birth is required)";
        $isValid = false;
    } else {
        $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
        $today = new DateTime();
        $age = $today->diff($dobDate)->y;

        if ($age < 18) {
            $doberr = "* (Must be at least 18 years old)";
            $isValid = false;
        }
    }

    $emailCheckSql = "SELECT * FROM data WHERE email = ?";
    $stmt = $conn->prepare($emailCheckSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $emerr = "* (Email already registered)";
        $isValid = false;
    }
    $stmt->close();

    if ($isValid) {
        $stmt = $conn->prepare("INSERT INTO data (first_name, last_name, dob, email, password, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstName, $lastName, $dob, $email, $password, $phone, $address);

        if ($stmt->execute()) {
            $showAlert = true; 
            echo "<script>
                    alert('Registration successful!');
                    window.location.href = 'login.php';
                  </script>";
            exit;
        } else {
            echo "Error: " . $stmt->error;
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
    <title>Registration</title>
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
            <h2 class="text-center text-darkslategray mb-4">Registration Form</h2>
            <form method="POST" class="bg-light p-4 rounded shadow">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($firstName ?? ''); ?>" autocomplete="off">
                    <span class="error"><?php echo $fnerr; ?></span>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($lastName ?? ''); ?>" autocomplete="off">
                    <span class="error"><?php echo $lnerr; ?></span>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($dob ?? ''); ?>" autocomplete="off">
                    <span class="error"><?php echo $doberr; ?></span>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo htmlspecialchars($address ?? ''); ?>" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number" maxlength="10" value="<?php echo htmlspecialchars($phone ?? ''); ?>" autocomplete="off">
                    <span class="error"><?php echo $phoneerr; ?></span>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="xyz@gmail.com" autocomplete="off">
                    <span class="error"><?php echo $emerr; ?></span>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete="off">
                    <span class="error"><?php echo $passerr; ?></span>
                </div>

                <div class="text-center">
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-success">
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

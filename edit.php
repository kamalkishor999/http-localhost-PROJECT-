<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $updateStmt = $conn->prepare("UPDATE data SET first_name=?, last_name=?, dob=?, address=?, phone=? WHERE email=?");
    $updateStmt->bind_param("ssssss", $first_name, $last_name, $dob, $address, $phone, $email);
    if ($updateStmt->execute()) {
        echo "<script>alert('Details updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating details.');</script>";
    }
    $updateStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Edit Your Details</h2>

        <form method="POST" class="mt-4">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo htmlspecialchars($userDetails['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo htmlspecialchars($userDetails['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control" value="<?php echo htmlspecialchars($userDetails['dob']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" required><?php echo htmlspecialchars($userDetails['address']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($userDetails['phone']); ?>" required>
            </div>
            <div class="d-flex justify-content-center mb-3">
    <button type="submit" class="btn btn-success mx-2">Update Details</button>
    <a href="logindetails.php" class="btn btn-secondary mx-2">Back to Profile</a>
</div>

        </form>
    </div>
</body>
</html>

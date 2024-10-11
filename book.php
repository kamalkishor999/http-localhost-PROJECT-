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
$message = ""; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'], $_POST['first_name'], $_POST['password'], $_POST['product_name'], $_POST['product_description'], $_POST['product_price'])) {
        $email = $_POST['email'];
        $firstName = $_POST['first_name'];
        $password = $_POST['password'];
        $productName = $_POST['product_name'];
        $productDescription = $_POST['product_description'];
        $productPrice = $_POST['product_price'];
        $bookingDate = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("SELECT * FROM data WHERE email = ? AND first_name = ? AND password = ?");
        $stmt->bind_param("sss", $email, $firstName, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt = $conn->prepare("INSERT INTO bookings (first_name, email, product_name, product_description, product_price, booking_date) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $firstName, $email, $productName, $productDescription, $productPrice, $bookingDate);
            
            if ($stmt->execute()) {
                header("Location: dashboard.php");
                exit; 
            } else {
                $message = "Failed to book product. Please try again.";
            }
        } else {
            $message = "Not Registered, You need to register firstly";
        }

        $stmt->close();
    } else {
        $message = "Please fill in all required fields.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .error { color: red; }
        body {
            background-image: url(./back.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            padding: 20px;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .product-card {
            margin: 15px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: box-shadow 0.2s;
        }
        .product-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        .btn-custom {
            background-color: #ff6f61; 
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-right mb-4">
            <div id="bookingMessage" class="text-center mt-3">
                <?php if ($message) echo '<div class="alert alert-warning">' . $message . '</div>'; ?>
            </div>
            Click here to :
            <button class="btn btn-primary" onclick="window.location.href='contact.php'">Register</button>
        </div>
        
        <h3 class="text-center my-4">Featured Makeup Products</h3>

        <div class="row" id="products">
            <div class="col-md-4">
                <div class="product-card" onclick="selectProduct('Glamorous Foundation', 'A lightweight foundation that provides full coverage and a natural finish.', '30.00')">
                    <h5>Glamorous Foundation</h5>
                    <p>A lightweight foundation that provides full coverage and a natural finish.</p>
                    <p><strong>Price:</strong> $30.00</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card" onclick="selectProduct('Vibrant Lipstick', 'Long-lasting lipstick with a creamy texture and intense color.', '20.00')">
                    <h5>Vibrant Lipstick</h5>
                    <p>Long-lasting lipstick with a creamy texture and intense color.</p>
                    <p><strong>Price:</strong> $20.00</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card" onclick="selectProduct('Radiant Blush', 'A silky blush that gives your cheeks a healthy glow.', '15.00')">
                    <h5>Radiant Blush</h5>
                    <p>A silky blush that gives your cheeks a healthy glow.</p>
                    <p><strong>Price:</strong> $15.00</p>
                </div>
            </div>
        </div>

        <h2 class="text-center my-4">Booking Details</h2>
        <div class="form-container">
            <form id="bookingForm" method="POST">
                <input type="hidden" name="product_name" id="product_name">
                <input type="hidden" name="product_description" id="product_description">
                <input type="hidden" name="product_price" id="product_price">
                
                <div class="form-group">
                    <label>Selected Product:</label>
                    <p id="product_name_display" class="form-control-plaintext"></p>
                </div>
                <div class="form-group">
                    <label>Product Price:</label>
                    <p id="product_price_display" class="form-control-plaintext"></p>
                </div>
                
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="xyz@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-custom" style="width: 11%;">Book Now</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function selectProduct(name, description, price) {
            document.getElementById('product_name').value = name;
            document.getElementById('product_description').value = description;
            document.getElementById('product_price').value = price;
            document.getElementById('product_name_display').innerText = name;
            document.getElementById('product_price_display').innerText = price;

            alert(`Selected Product: ${name}`);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

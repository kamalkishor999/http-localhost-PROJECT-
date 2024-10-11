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
$sql = "SELECT * FROM bookings ORDER BY booking_date DESC"; // Fetching bookings ordered by date
$result = $conn->query($sql);

// Determine the latest product
$latestProductId = null;
if ($result->num_rows > 0) {
    $latestProduct = $result->fetch_assoc(); // Get the latest product
    $latestProductId = $latestProduct['id']; // Assuming 'id' is the unique identifier
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(./back.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            padding: 20px;
        }
        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .latest-product {
            background-color: #f8e6b8; /* Light yellow background for the latest product */
            border: 2px solid #ffcc00; /* Gold border */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center my-4">All Bookings</h2>
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Price</th>
                        <th>Booking Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php
                        // Reset pointer to the start of the result set
                        $result->data_seek(0);
                        while ($row = $result->fetch_assoc()):
                        ?>
                            <tr <?php if ($row['id'] == $latestProductId) echo 'class="latest-product"'; ?>> <!-- Highlight latest product -->
                                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_description']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                                <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                                <td>
                                    <form action="pay.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>"> <!-- Assuming 'id' is the unique identifier -->
                                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>">
                                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['product_price']); ?>">
                                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"> <!-- Include email -->
                                        <button type="submit" class="btn btn-primary">Buy</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No bookings found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>

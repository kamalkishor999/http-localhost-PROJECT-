<?php
require 'vendor/autoload.php'; 

session_start();
\Stripe\Stripe::setApiKey('sk_test_51OyUMHSBMjjIWhVuHbywYDz9kUmGmN4K6xWUaG8adfIxhGEs7nJ8Ky3wD93wJ8gBcXs2RJBkWVEBfFZHPabjC0w400BaXnqCaW'); 

if ($_SERVER['REQUEST_METHOD'] === 'post') {
    file_put_contents('debug.log', print_r($_POST, true)); 

    if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['email'])) {
        $product_id = htmlspecialchars($_POST['product_id']);
        $productName = htmlspecialchars($_POST['product_name']);
        $productPrice = htmlspecialchars($_POST['product_price']) * 100; 
        $email = htmlspecialchars($_POST['email']); 

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $productPrice,
                'currency' => 'usd',
                'description' => $productName,
                'receipt_email' => $email, 
            ]);

            echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;
    } else {
        echo json_encode(['error' => 'Missing product data.']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .payment-form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .payment-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        #card-element {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        #payment-message {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="payment-form">
        <h2>Make a Payment</h2>
        <form id="payment-form">
            <input type="hidden" id="product_id" name="product_id" value="<?php echo isset($_POST['product_id']) ? htmlspecialchars($_POST['product_id']) : ''; ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="product_price">Product Price (USD):</label>
                <input type="number" id="product_price" name="product_price" class="form-control" value="<?php echo isset($_POST['product_price']) ? htmlspecialchars($_POST['product_price']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="card-element">Credit or Debit Card:</label>
                <div id="card-element"></div>
                <div id="card-errors" role="alert"></div>
            </div>
            <button id="submit" class="btn btn-primary btn-block mt-3">Pay</button>
            <div id="payment-message" class="mt-2"></div>
        </form>
    </div>

    <script>
        const stripe = Stripe('pk_test_51OyUMHSBMjjIWhVuN8BJtkbwC9ZqOVRN6GCKCOix3JqAdqHK8mHMcZddNEbN5GxIaSe4uIIVQ0vzxcSnb5MEnJTg00cMZopyo5'); 
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');
        const form = document.getElementById('payment-form');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { clientSecret, error } = await fetch('pay.php', {
                method: 'POST',
                body: new URLSearchParams(new FormData(form)),
            }).then(r => r.json());

            if (error) {
                document.getElementById('payment-message').innerText = error;
            } else {
                const { error: stripeError } = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: cardElement,
                    },
                });

                if (stripeError) {
                    document.getElementById('payment-message').innerText = stripeError.message;
                } else {
                    document.getElementById('payment-message').innerText = 'Payment successful!';
                }
            }
        });
    </script>
</body>
</html>

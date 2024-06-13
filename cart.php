<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce"; // Update database name here

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['checkout'])) {
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];

    foreach ($_SESSION['cart'] as $item_id => $item) {
        $product_name = $item['name'];
        $price = $item['price'];
        $quantity = $item['quantity'];
        
        for ($i = 0; $i < $quantity; $i++) {
            $sql = "INSERT INTO orders (customers_name, product, price, address) 
                    VALUES ('$customer_name', '$product_name', '$price', '$address')";
            $conn->query($sql);
        }
    }
    
    // Clear the cart after checkout
    unset($_SESSION['cart']);
    
    echo "Order placed successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        nav.main-menu {
            margin-bottom: 20px;
        }
        nav.main-menu ul {
            list-style-type: none;
            padding: 0;
        }
        nav.main-menu ul li {
            display: inline;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <nav class="main-menu">
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    <h1>Your Cart</h1>
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
    <table border="1">
        <tr>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php 
        $total = 0;
        foreach ($_SESSION['cart'] as $item_id => $item): 
            $total += $item['price'] * $item['quantity'];
        ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $item['price'] * $item['quantity']; ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Total</td>
            <td><?php echo $total; ?></td>
        </tr>
    </table>
    <br>
    <form method="post" action="">
        <h2>Checkout</h2>
        <label for="customer_name">Name:</label>
        <input type="text" id="customer_name" name="customer_name" required><br><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>
        <input type="submit" name="checkout" value="Checkout">
    </form>
    <?php else: ?>
    <p>Your cart is empty.</p>
    <?php endif; ?>
    <br>
    <a href="catalog.php">Back to Catalog</a>
</body>
</html>

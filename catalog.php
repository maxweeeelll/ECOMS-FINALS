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

// Fetch items from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
$items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Add to cart functionality
if (isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    
    // Fetch the item details from the database
    $sql = "SELECT * FROM items WHERE id=$item_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        $product_name = $item['name'];
        $price = $item['price'];
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if (isset($_SESSION['cart'][$item_id])) {
            $_SESSION['cart'][$item_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$item_id] = [
                "name" => $product_name,
                "price" => $price,
                "quantity" => $quantity,
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catalog</title>
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
    <h1>Catalog</h1>
    <table border="1">
        <tr>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <input type="submit" name="add_to_cart" value="Add to Cart">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="cart.php">Go to Cart</a>
</body>
</html>

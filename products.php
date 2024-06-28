<?php
session_start();

// Check if user is logged in, redirect if not
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

// Simulated database or array of products
$featuredProducts = [
    ['id' => 1, 'name' => 'Treadmill', 'image' => 'images/product1.jpg', 'description' => 'Top-quality treadmill for cardio workouts.', 'price' => 199.99],
    ['id' => 2, 'name' => 'Dumbbell Set', 'image' => 'images/product2.jpg', 'description' => 'Complete dumbbell set for strength training.', 'price' => 299.99],
    ['id' => 3, 'name' => 'Exercise Bike', 'image' => 'images/product3.jpg', 'description' => 'Indoor exercise bike with adjustable settings.', 'price' => 399.99],
    ['id' => 4, 'name' => 'Yoga Mat', 'image' => 'images/product4.jpg', 'description' => 'Premium yoga mat for flexibility and comfort.', 'price' => 19.99],
    ['id' => 5, 'name' => 'Weight Bench', 'image' => 'images/product5.jpg', 'description' => 'Versatile weight bench for various exercises.', 'price' => 499.99],
    ['id' => 6, 'name' => 'Resistance Bands', 'image' => 'images/product6.jpg', 'description' => 'Set of resistance bands for full-body workouts.', 'price' => 29.99],
    ['id' => 7, 'name' => 'Gym Ball', 'image' => 'images/product7.jpg', 'description' => 'Stability ball for core strength and balance exercises.', 'price' => 24.99],
    ['id' => 8, 'name' => 'Jump Rope', 'image' => 'images/product8.jpg', 'description' => 'Adjustable jump rope for cardio and endurance.', 'price' => 9.99],
    ['id' => 9, 'name' => 'Kettlebell Set', 'image' => 'images/product9.jpg', 'description' => 'Various weights of kettlebells for strength and conditioning.', 'price' => 149.99],
    ['id' => 10, 'name' => 'Pull-Up Bar', 'image' => 'images/product10.jpg', 'description' => 'Doorway pull-up bar for upper body strength training.', 'price' => 34.99],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Overload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f0f0f0;
        }

        .navbar {
            background-color: #1a1a1a;
            color: #fff;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            color: #fff;
            text-decoration: none;
            font-size: 1.8rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
        }

        .nav-menu li {
            margin-left: 1.5rem;
        }

        .nav-menu a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover {
            color: #ff6b6b;
        }

        .logout-btn {
            background-color: #ff6b6b;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff4757;
        }

        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('gym-background.jpg');
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            max-width: 600px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 2rem 0;
        }

        .sidebar {
            background-color: #f0f0f0;
            padding: 2rem;
            flex: 0 0 250px; /* Fixed width for the sidebar */
        }

        .sidebar h3 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 1rem;
        }

        .sidebar a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .sidebar a:hover {
            color: #ff6b6b;
        }

        .featured-products {
            flex: 1; /* Allow the featured products section to grow */
            padding: 0 2rem;
            text-align: center;
        }

        .featured-products h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #333;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-item {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-item:hover {
            transform: translateY(-5px);
        }

        .product-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-info h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .product-info p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff6b6b;
            align-self: flex-end;
        }

        .add-to-cart {
            margin-top: auto;
            align-self: center;
            background-color: #ff6b6b;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .add-to-cart:hover {
            background-color: #ff4757;
        }

        footer {
            background-color: #1a1a1a;
            color: #fff;
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-links {
            display: flex;
            list-style: none;
        }

        .footer-links li {
            margin-left: 1rem;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #ff6b6b;
        }

        /* Media query for responsiveness */
        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .sidebar {
                flex: 0 0 100%; /* Sidebar takes full width on smaller screens */
                margin-bottom: 2rem;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-menu {
                margin-top: 1rem;
            }

            .nav-menu li {
                margin-left: 0;
                margin-right: 1rem;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="navbar-content">
            <div class="logo">
                <a href="index.php">Fitness Overload</a>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="user-actions">
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <h1>Forge Your Fitness Journey, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
        <p>Forge your perfect physique with our premium fitness equipment.</p>
    </section>

    <div class="container">
        <div class="sidebar">
            <h3>Categories</h3>
            <ul>
                <li><a href="#">Treadmills</a></li>
                <li><a href="#">Dumbbell Sets</a></li>
                <li><a href="#">Exercise Bikes</a></li>
                <li><a href="#">Yoga Mats</a></li>
                <li><a href="#">Weight Benches</a></li>
                <li><a href="#">Resistance Bands</a></li>
            </ul>
        </div>

        <section class="featured-products">
            <h2>Featured Products</h2>
            <div class="product-grid">
                <?php foreach ($featuredProducts as $product): ?>
                    <div class="product-item">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                            <a href="#" class="add-to-cart">Add to Cart</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Fitness Overload Equipment. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="terms.php">Terms of Service</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>

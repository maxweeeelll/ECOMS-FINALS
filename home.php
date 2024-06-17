<?php
session_start();

$featuredProducts = [
    ['id' => 1, 'name' => 'Treadmill', 'image' => 'product1.jpg', 'description' => 'Top-quality treadmill for cardio workouts.', 'price' => 199.99],
    ['id' => 2, 'name' => 'Dumbbell Set', 'image' => 'product2.jpg', 'description' => 'Complete dumbbell set for strength training.', 'price' => 299.99],
    ['id' => 3, 'name' => 'Exercise Bike', 'image' => 'product3.jpg', 'description' => 'Indoor exercise bike with adjustable settings.', 'price' => 399.99],
    ['id' => 4, 'name' => 'Yoga Mat', 'image' => 'product4.jpg', 'description' => 'Premium yoga mat for flexibility and comfort.', 'price' => 19.99],
    ['id' => 5, 'name' => 'Weight Bench', 'image' => 'product5.jpg', 'description' => 'Versatile weight bench for various exercises.', 'price' => 499.99],
    ['id' => 6, 'name' => 'Resistance Bands', 'image' => 'product6.jpg', 'description' => 'Set of resistance bands for full-body workouts.', 'price' => 29.99],
];

$testimonials = [
    ['name' => 'John Doe', 'content' => 'The equipment from Fitness Overload transformed my workouts!'],
    ['name' => 'Jane Smith', 'content' => 'Excellent customer service and high-quality products. Highly recommended!'],
    ['name' => 'Michael Brown', 'content' => 'Fast shipping and great prices. Will shop here again!'],
];

$services = [
    ['title' => 'Personal Training', 'description' => 'Tailored fitness programs with certified trainers.'],
    ['title' => 'Equipment Installation', 'description' => 'Professional installation services for gym equipment.'],
    ['title' => 'Fitness Assessments', 'description' => 'Comprehensive assessments to track your fitness progress.'],
    ['title' => 'Nutritional Consultations', 'description' => 'Nutrition plans customized to complement your workout regimen.'],
    ['title' => 'Equipment Maintenance', 'description' => 'Scheduled maintenance to keep your gym equipment in top condition.'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Overload</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Additional CSS styles can go here if needed */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            line-height: 1.6;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        .nav-menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav-menu li {
            position: relative;
        }

        .nav-menu li a {
            display: block;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .user-actions {
            display: flex;
            align-items: center;
        }

        .logout-btn {
            background-color: #ff6347;
            color: #fff;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #e65c4f;
        }

        .hero {
            background-color: #333;
            color: #fff;
            padding: 100px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .featured-products {
            padding: 50px 20px;
            text-align: center;
        }

        .featured-products h2 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .product-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .product-item {
            max-width: 300px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
            border-radius: 5px;
        }

        .product-item:hover {
            transform: translateY(-5px);
        }

        .product-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-item h3 {
            font-size: 24px;
            margin-top: 15px;
        }

        .product-item p {
            font-size: 16px;
            margin-top: 10px;
        }

        /* Testimonials Section */
        .testimonials {
            background-color: #f2f2f2;
            padding: 50px 20px;
            text-align: center;
        }

        .testimonial-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .testimonial-item {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
        }

        .testimonial-item blockquote {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .testimonial-item p {
            font-size: 16px;
            font-style: italic;
        }

        /* Services Section */
        .services {
            padding: 50px 20px;
            text-align: center;
        }

        .service-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .service-item {
            max-width: 300px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
        }

        .service-item h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .service-item p {
            font-size: 16px;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">
            <a href="home.php">Fitness Overload</a>
        </div>
        <ul class="nav-menu">
            <li><a href="home.php">Home</a></li>
            <li class="dropdown">
                <a href="#">Equipment <i class="fas fa-angle-down"></i></a>
                <div class="dropdown-content">
                    <a href="cardio.php">Cardio</a>
                    <a href="strength.php">Strength Training</a>
                    <a href="functional.php">Functional Training</a>
                    <a href="accessories.php">Accessories</a>
                </div>
            </li>
        </ul>
        <div class="user-actions">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </nav>
</header>

<main>
    <section class="hero">
        <div class="hero-content">
            <h1>Hello <?php echo htmlspecialchars($_SESSION['name']); ?>, Welcome to Fitness Overload!</h1>
            <p>Explore our wide range of gym equipment.</p>
        </div>
    </section>

    <section class="featured-products">
        <div class="container">
            <h2>Featured Products</h2>
            <div class="product-grid">
                <?php foreach ($featuredProducts as $product): ?>
                    <div class="product-item">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['description']; ?></p>
                        <p>$<?php echo $product['price']; ?></p>
                        <!-- <a href="#" class="btn">Add to Cart</a> -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2>Testimonials</h2>
            <div class="testimonial-grid">
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="testimonial-item">
                        <blockquote><?php echo $testimonial['content']; ?></blockquote>
                        <p>- <?php echo $testimonial['name']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="service-grid">
                <?php foreach ($services as $service): ?>
                    <div class="service-item">
                        <h3><?php echo $service['title']; ?></h3>
                        <p><?php echo $service['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<footer>
    <p>&copy; 2024 Fitness Overload. All rights reserved.</p>
</footer>

</body>
</html>

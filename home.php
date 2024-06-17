<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <nav class="main-menu">
                <ul>
                    <li><a href="catalog.php">Home</a></li>
                </ul>
     <h1>HELLO <?php echo $_SESSION['name'];?> , WELCOME TO FITNESS OVERLOAD</h1>
     <a href="logout.php">Logout</a>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>

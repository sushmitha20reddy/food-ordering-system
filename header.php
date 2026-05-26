<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Food Ordering System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header style="background-color: #f44336; color: white; padding: 10px;">
        <h1>Food Ordering System</h1>
        <nav>
            <a href="index.php" style="margin-right: 15px; color: white;">Home</a>
            <a href="menu.php" style="margin-right: 15px; color: white;">Menu</a>
            <a href="cart.php" style="margin-right: 15px; color: white;">Cart</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" style="color: white;">Logout</a>
            <?php else: ?>
                <a href="login.php" style="margin-right: 15px; color: white;">Login</a>
                <a href="register.php" style="color: white;">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <main style="padding: 20px;">

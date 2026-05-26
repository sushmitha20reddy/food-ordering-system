<?php
include '../includes/db.php';

$count_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$count_food = $conn->query("SELECT COUNT(*) as total FROM food_items")->fetch_assoc()['total'];
$count_orders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];

echo "<h2>Admin Dashboard</h2>";
echo "<p>Total Users: $count_users</p>";
echo "<p>Total Food Items: $count_food</p>";
echo "<p>Total Orders: $count_orders</p>";

echo "<a href='view_orders.php'>View Orders</a> | <a href='add_food.php'>Add Food</a>";
?>

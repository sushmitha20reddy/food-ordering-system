<?php
session_start();
include 'includes/db.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if cart is empty
if (empty($_SESSION['cart'])) {
    echo "❌ Your cart is empty.";
    exit();
}

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];

// Fetch food prices from DB
$ids = implode(',', array_keys($cart));
$result = $conn->query("SELECT * FROM food_items WHERE id IN ($ids)");

$total = 0;
$items = [];
while ($row = $result->fetch_assoc()) {
    $food_id = $row['id'];
    $price = $row['price'];
    $quantity = $cart[$food_id];
    $subtotal = $price * $quantity;
    $total += $subtotal;
    $items[] = ['food_id' => $food_id, 'quantity' => $quantity];
}

// Insert into orders table
$conn->query("INSERT INTO orders (user_id, total_price) VALUES ($user_id, $total)");
$order_id = $conn->insert_id;

// Insert into order_items
foreach ($items as $item) {
    $conn->query("INSERT INTO order_items (order_id, food_id, quantity)
                  VALUES ($order_id, {$item['food_id']}, {$item['quantity']})");
}

// Clear cart
unset($_SESSION['cart']);

echo "<h3>✅ Order placed successfully! Order ID: $order_id</h3>";
echo "<a href='menu.php'>Back to Menu</a>";
?>

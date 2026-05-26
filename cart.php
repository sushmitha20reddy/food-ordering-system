<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$food_id] = $quantity;
}

echo "<h2>Your Cart</h2>";

if (empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
} else {
    $ids = implode(",", array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM food_items WHERE id IN ($ids)");

    $total = 0;
    echo "<form action='checkout.php' method='POST'>";
    echo "<table border='1' cellpadding='10'><tr><th>Item</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $qty = $_SESSION['cart'][$row['id']];
        $subtotal = $qty * $row['price'];
        $total += $subtotal;
        echo "<tr>
                <td>{$row['name']}</td>
                <td>₹{$row['price']}</td>
                <td>{$qty}</td>
                <td>₹$subtotal</td>
              </tr>";
    }

    echo "<tr><td colspan='3'>Total</td><td>₹$total</td></tr>";
    echo "</table><br>";
    echo "<button type='submit'>Proceed to Checkout</button>";
    echo "</form>";
}

include 'includes/footer.php';
?>

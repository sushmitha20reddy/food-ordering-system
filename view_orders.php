<?php
include '../includes/db.php';

$sql = "SELECT o.id AS order_id, u.name AS customer, o.total_price, o.order_date
        FROM orders o
        JOIN users u ON o.user_id = u.id
        ORDER BY o.order_date DESC";

$orders = $conn->query($sql);

echo "<h2>All Orders</h2>";
while ($order = $orders->fetch_assoc()) {
    echo "<h4>Order #{$order['order_id']} - {$order['customer']} - ₹{$order['total_price']} - {$order['order_date']}</h4>";

    $order_id = $order['order_id'];
    $items = $conn->query("SELECT f.name, oi.quantity, f.price
                           FROM order_items oi
                           JOIN food_items f ON oi.food_id = f.id
                           WHERE oi.order_id = $order_id");

    echo "<ul>";
    while ($item = $items->fetch_assoc()) {
        $total = $item['quantity'] * $item['price'];
        echo "<li>{$item['name']} x {$item['quantity']} = ₹$total</li>";
    }
    echo "</ul><hr>";
}
?>

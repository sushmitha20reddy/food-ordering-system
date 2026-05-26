<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}

include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    // Upload Image
    $image = $_FILES['image']['name'];
    $target = "../assets/images/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $stmt = $conn->prepare("INSERT INTO food_items (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $image);
    $stmt->execute();
    $message = "Food item added!";
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Food</title></head>
<body>
<h2>Add New Food Item</h2>
<a href="view_orders.php">View Orders</a> | <a href="index.php">Logout</a><br><br>

<form method="post" enctype="multipart/form-data">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>
    <label>Price (₹):</label><br>
    <input type="number" step="0.01" name="price" required><br><br>
    <label>Image:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>
    <button type="submit">Add Food</button>
</form>
<?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>
</body>
</html>

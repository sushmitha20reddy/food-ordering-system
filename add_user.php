<?php
$conn = new mysqli("localhost", "root", "", "food_ordering");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = "Test User";
$email = "test@example.com";
$password = password_hash("123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);
$stmt->execute();

echo "✅ User inserted.";
?>

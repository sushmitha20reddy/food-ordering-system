<?php
$conn = new mysqli("localhost", "root", "", "food_ordering");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = 'test@example.com';
$password = password_hash('123456', PASSWORD_DEFAULT);

$sql = "UPDATE users SET password = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $newPassword, $email);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "✅ Password updated successfully!";
} else {
    echo "⚠️ Failed to update password. Email may not exist.";
}
?>

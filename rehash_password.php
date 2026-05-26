<?php
include 'includes/db.php';

$email = 'test@example.com';
$newPassword = '123456';
$hashed = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $hashed, $email);

if ($stmt->execute()) {
    echo "✅ Password updated successfully to: $newPassword<br>";
    echo "New hashed password: $hashed";
} else {
    echo "❌ Failed to update password.";
}
?>

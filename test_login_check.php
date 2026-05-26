<?php
include 'includes/db.php';

$email = 'test@example.com';
$password = '123456';

$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $hashed = $row['password'];

    echo "Plain password: $password<br>";
    echo "Hashed password: $hashed<br>";

    if (password_verify($password, $hashed)) {
        echo "✅ Password matches.";
    } else {
        echo "❌ Password does NOT match.";
    }
} else {
    echo "❌ No user found.";
}
?>

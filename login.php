<?php
session_start();
include 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    // Fetch user by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();

        // DEBUG (Optional - remove in production)
        echo "Entered: $pass<br>";
        echo "Stored Hash: " . $user['password'] . "<br>";
        echo "Verify: ";
        var_dump(password_verify($pass, $user['password']));
        echo "<br>";

        if (password_verify($pass, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            header("Location: menu.php");
            exit();
        } else {
            $error = "❌ Password is incorrect.";
        }
    } else {
        $error = "❌ Email not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; padding: 30px; }
        .error { color: red; font-weight: bold; }
        .success { color: green; }
        input { padding: 5px; margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>Login</h2>

<?php if ($error): ?>
    <p class="error">❌ <?= $error ?></p>
<?php endif; ?>

<form method="post" action="">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

</body>
</html>

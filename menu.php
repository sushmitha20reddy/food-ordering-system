<?php
include 'includes/db.php';
include 'includes/header.php';

$result = $conn->query("SELECT * FROM food_items");
?>

<h2>Menu</h2>
<div style="display: flex; flex-wrap: wrap; gap: 20px;">
<?php while ($row = $result->fetch_assoc()): ?>
    <div style="border: 1px solid #ccc; padding: 15px; width: 200px;">
        <img src="assets/images/<?= $row['image'] ?>" width="180" height="150" alt="<?= $row['name'] ?>"><br>
        <h4><?= $row['name'] ?></h4>
        <p>₹<?= $row['price'] ?></p>
        <form action="cart.php" method="POST">
            <input type="hidden" name="food_id" value="<?= $row['id'] ?>">
            <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
<?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>

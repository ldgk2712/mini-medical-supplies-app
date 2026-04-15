<?php

$supplies = require __DIR__ . '/../src/Data/supplies.php';
require __DIR__ . '/../src/Helpers/functions.php';

$totalSupplies = count($supplies);
$totalQuantity = getTotalSupplyQuantity($supplies);
$availableSupplies = getAvailableSupplies($supplies);
$availableCount = count($availableSupplies);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical Supplies List</title>
</head>
<body>
    <h1>Medical Supplies List</h1>

    <h2>Statistics</h2>
    <ul>
        <li>Total supply types: <?php echo $totalSupplies; ?></li>
        <li>Total quantity: <?php echo $totalQuantity; ?></li>
        <li>Available supplies: <?php echo $availableCount; ?></li>
    </ul>

    <h2>Supply Details</h2>

    <?php foreach ($supplies as $supply): ?>
        <div style="margin-bottom: 16px; padding: 8px; border: 1px solid #ccc;">
            <p><strong>Name:</strong> <?php echo formatSupplyName($supply['name']); ?></p>
            <p><strong>Category:</strong> <?php echo $supply['category']; ?></p>
            <p><strong>Location:</strong> <?php echo $supply['location']; ?></p>
            <p><strong>Quantity:</strong> <?php echo $supply['quantity']; ?></p>
            <p><strong>Status:</strong> <?php echo getSupplyStatus($supply['quantity']); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
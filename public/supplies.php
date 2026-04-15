<?php

$supplies = require __DIR__ . '/../src/Data/supplies.php';
require __DIR__ . '/../src/Helpers/functions.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$statusFilter = isset($_GET['status']) ? trim($_GET['status']) : 'all';

$totalSupplies = count($supplies);
$totalQuantity = getTotalSupplyQuantity($supplies);
$availableCount = count(getAvailableSupplies($supplies));
$lowStockCount = count(getLowStockSupplies($supplies));
$outOfStockCount = count(getOutOfStockSupplies($supplies));

$filteredSupplies = searchSuppliesByName($supplies, $keyword);
$filteredSupplies = filterSuppliesByStatus($filteredSupplies, $statusFilter);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical Supplies List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f7f9fc;
            color: #222;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h1, h2 {
            margin-bottom: 12px;
        }

        .top-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #0a58ca;
            text-decoration: none;
        }

        .top-link:hover {
            text-decoration: underline;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
        }

        .filters {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .filters form {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: end;
        }

        .filters label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .filters input,
        .filters select {
            padding: 8px;
            min-width: 220px;
        }

        .filters button,
        .filters a {
            padding: 10px 14px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #0a58ca;
            color: #fff;
        }

        .btn-secondary {
            background: #6c757d;
            color: #fff;
        }

        .cards {
            display: grid;
            gap: 16px;
        }

        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
        }

        .card p {
            margin: 8px 0;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: bold;
        }

        .status-available {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-low {
            background: #fff3cd;
            color: #664d03;
        }

        .status-out {
            background: #f8d7da;
            color: #842029;
        }

        .empty-message {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a class="top-link" href="/index.php">← Back to Home</a>

        <h1>Medical Supplies List</h1>

        <h2>Statistics</h2>
        <div class="stats">
            <div class="stat-card">
                <strong>Total supply types:</strong>
                <p><?php echo $totalSupplies; ?></p>
            </div>
            <div class="stat-card">
                <strong>Total quantity:</strong>
                <p><?php echo $totalQuantity; ?></p>
            </div>
            <div class="stat-card">
                <strong>Available supplies:</strong>
                <p><?php echo $availableCount; ?></p>
            </div>
            <div class="stat-card">
                <strong>Low stock supplies:</strong>
                <p><?php echo $lowStockCount; ?></p>
            </div>
            <div class="stat-card">
                <strong>Out of stock supplies:</strong>
                <p><?php echo $outOfStockCount; ?></p>
            </div>
        </div>

        <div class="filters">
            <h2>Search and Filter</h2>
            <form method="GET" action="">
                <div>
                    <label for="keyword">Search by name</label>
                    <input
                        type="text"
                        id="keyword"
                        name="keyword"
                        value="<?php echo htmlspecialchars($keyword); ?>"
                        placeholder="Enter supply name"
                    >
                </div>

                <div>
                    <label for="status">Filter by status</label>
                    <select id="status" name="status">
                        <option value="all" <?php echo $statusFilter === 'all' ? 'selected' : ''; ?>>All</option>
                        <option value="available" <?php echo $statusFilter === 'available' ? 'selected' : ''; ?>>Available</option>
                        <option value="low" <?php echo $statusFilter === 'low' ? 'selected' : ''; ?>>Low stock</option>
                        <option value="out" <?php echo $statusFilter === 'out' ? 'selected' : ''; ?>>Out of stock</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn-primary">Apply</button>
                    <a class="btn-secondary" href="/supplies.php">Reset</a>
                </div>
            </form>
        </div>

        <h2>Supply Details</h2>

        <?php if (count($filteredSupplies) > 0): ?>
            <div class="cards">
                <?php foreach ($filteredSupplies as $supply): ?>
                    <?php $status = getSupplyStatus($supply['quantity']); ?>
                    <div class="card">
                        <p><strong>Name:</strong> <?php echo formatSupplyName($supply['name']); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($supply['category']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($supply['location']); ?></p>
                        <p><strong>Quantity:</strong> <?php echo $supply['quantity']; ?></p>
                        <p>
                            <strong>Status:</strong>
                            <span class="status <?php echo getStatusClass($status); ?>">
                                <?php echo $status; ?>
                            </span>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-message">
                No medical supplies matched your search or filter.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
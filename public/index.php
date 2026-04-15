<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini Medical Supplies App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f7f9fc;
            color: #222;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 24px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        h1 {
            margin-top: 0;
        }

        a {
            color: #0a58ca;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            margin-top: 12px;
            padding: 10px 16px;
            background: #0a58ca;
            color: #fff;
            border-radius: 6px;
        }

        .btn:hover {
            background: #084298;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mini Medical Supplies App</h1>
        <p>Welcome to the medical supplies management system.</p>
        <p>This application helps display medical supplies, stock status, and summary statistics.</p>

        <a class="btn" href="/supplies.php">View Medical Supplies</a>
    </div>
</body>
</html>
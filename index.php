<?php
// Database connection settings
$host = 'localhost';
$db = 'finance_db';
$user = 'finance_user';
$pass = 'Racoon@35';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM transactions ORDER BY created_at DESC LIMIT 20";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Viewer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }
        main {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>

<header>
    <h1>Recent Transactions</h1>
</header>

<main>
    <p>Below are the most recent 20 transactions from the finance system:</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['user_id']) ?></td>
                        <td>$<?= number_format($row['amount'], 2) ?></td>
                        <td><?= htmlspecialchars($row['transaction_type']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7">No transactions found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<footer>
    &copy; 2025 Your Name
</footer>

</body>
</html>

<?php
$conn->close();
?>

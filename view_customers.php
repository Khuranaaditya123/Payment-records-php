<?php
include 'db.php';

$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View All Customers</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>All Customers</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Current Balance</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['current_balance']; ?></td>
                <td><a class="button" href="view_customer.php?id=<?php echo $row['id']; ?>">View</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

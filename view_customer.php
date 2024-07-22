<?php
include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM customers WHERE id = $id";
$result = $conn->query($sql);
$customer = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Customer</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Customer Details</h1>
        <p>ID: <?php echo $customer['id']; ?></p>
        <p>Name: <?php echo $customer['name']; ?></p>
        <p>Email: <?php echo $customer['email']; ?></p>
        <p>Current Balance: <?php echo $customer['current_balance']; ?></p>
        <a class="button" href="transfer_money.php?from=<?php echo $customer['id']; ?>">Transfer Money</a>
    </div>
</body>
</html>

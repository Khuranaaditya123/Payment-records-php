<?php
include 'db.php';

$from_customer_id = $_GET['from'];

$sql = "SELECT * FROM customers WHERE id != $from_customer_id";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to_customer_id = $_POST['to_customer_id'];
    $amount = $_POST['amount'];

    $conn->begin_transaction();

    try {
        $conn->query("UPDATE customers SET current_balance = current_balance - $amount WHERE id = $from_customer_id");
        $conn->query("UPDATE customers SET current_balance = current_balance + $amount WHERE id = $to_customer_id");
        $conn->query("INSERT INTO transfers (from_customer_id, to_customer_id, amount) VALUES ($from_customer_id, $to_customer_id, $amount)");

        $conn->commit();
        echo "<p class='success'>Transaction successful!</p>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "<p class='error'>Transaction failed: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transfer Money</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Transfer Money</h1>
        <form method="post">
            <label for="to_customer_id">Select Customer to Transfer Money To:</label>
            <select name="to_customer_id" required>
                <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="amount">Amount:</label>
            <input type="number" name="amount" required>
            <br>
            <button type="submit" class="button">Transfer</button>
        </form>
        <a class="button" href="view_customers.php">Back to Customers List</a>
    </div>
</body>
</html>

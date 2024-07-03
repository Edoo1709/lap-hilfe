<?php

require_once 'config.php';

$customer_id = $_GET['customer_id'] ?? '';

// Get all users from the database
try {
    if ($customer_id) {
        $sql = 'SELECT * FROM orders WHERE customer_id = :customer_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['customer_id' => $customer_id]);
        $orders = $stmt->fetchAll();
    } else {
        $sql = 'SELECT * FROM orders';
        $stmt = $pdo->query($sql);
        $orders = $stmt->fetchAll();
    }
} catch (Exception $e) {
    echo 'Fehler beim Abrufen der Bestellungen: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellungen anzeigen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="container mx-auto p-4 flex flex-col items-center gap-4 bg-gray-100 text-center rounded-lg shadow-lg mt-8">
        <h1 class="text-4xl">Bestellungen anzeigen</h1>
        <p>Übersicht aller Bestellungen.</p>
        <div class="flex gap-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Order_ID</th>
                        <th class="px-4 py-2">Customer_ID</th>
                        <th class="px-4 py-2">Bestelldatum</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $order['order_id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $order['customer_id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $order['order_date']; ?></td>
                            <td class="border px-4 py-2"><?php echo $order['status']; ?></td>
                            <td class="border px-4 py-2">
                                <a href="delete_orders.php?order_id=<?php echo $order['order_id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Löschen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Zurück zur Startseite</a>
    </section>
</body>
</html>
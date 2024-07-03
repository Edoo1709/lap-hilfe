<?php
require_once 'config.php';
    // Check if the user ID is provided
    if (!isset($_GET['customer_id'])) {
        echo 'Benutzer-ID nicht gefunden!';
        exit;
    }
    // Get the user ID from the URL
    $id = $_GET['customer_id'];
    try {
        $sql = 'DELETE FROM customers WHERE customer_id = :customer_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['customer_id' => $id]);

        header('Location: show.php');
    } catch (Exception $e) {
        echo 'Löschen Sie zuerst alle Bestellungen mit der selben ID ';
        echo '<br />';
        echo "<a href=show_orders.php?customer_id=$id>Bestellungen anzeigen</a>";
    }
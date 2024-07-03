<?php
require_once 'config.php';
    // Check if the user ID is provided
    if (!isset($_GET['order_id'])) {
        echo 'Bestellungs-ID nicht gefunden!';
        exit;
    }
    // Get the user ID from the URL
    $id = $_GET['order_id'];
    try {
        $sql1 = 'DELETE FROM order_items where order_id = :order_id';
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute(['order_id' => $id]);

        $sql = 'DELETE FROM orders WHERE order_id = :order_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['order_id' => $id]);

        header('Location: show_orders.php');
    } catch (Exception $e) {
        echo 'Fehler beim Löschen des Benutzers: ' . $e->getMessage();
    }


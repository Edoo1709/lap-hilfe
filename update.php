<?php

require_once 'config.php';

// Form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and email from the form
    $id = $_POST['customer_id'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone= $_POST['phone'];

    // Validate the username and email
    if (empty($firstname) || empty($lastname) || empty($email)|| empty($phone) ) { 
        echo 'Bitte füllen Sie alle Felder aus!';
        exit;
    }

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Ungültige E-Mail-Adresse!';
        exit;
    }

    // Update the user in the database
    try {
        $sql = 'UPDATE customers SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone WHERE customer_id = :customer_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['first_name' => $firstname,'last_name' => $lastname, 'email' => $email,'phone' => $phone, 'customer_id' => $id]);

        echo 'Kunde bearbeitet!';
        header('Location: show.php');
    } catch (Exception $e) {
        echo 'Fehler beim Aktualisieren des Benutzers: ' . $e->getMessage();
    }
}

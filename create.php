<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and email from the form
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Validate the username and email
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone)) {
        echo 'Bitte füllen Sie alle Felder aus!';
        exit;
    }

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Ungültige E-Mail-Adresse!';
        exit;
    }

    // Insert the user into the database
    try {
        $sql = 'INSERT INTO customers (first_name, last_name, email, phone) VALUES (:first_name, :last_name, :email, :phone)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['first_name' => $firstname, 'last_name' => $lastname, 'email' => $email, 'phone'=> $phone]);

        echo 'Benutzer erstellt!';
    } catch (Exception $e) {
        echo 'Fehler beim Erstellen des Benutzers: ' . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer erstellen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="container mx-auto p-4 flex flex-col items-center gap-4 bg-gray-100 text-center rounded-lg shadow-lg mt-8">
        <h1 class="text-4xl">Benutzer erstellen</h1>
        <p>Erstellen Sie einen neuen Benutzer.</p>
        <div class="flex gap-4">
            <form action="create.php" method="post" class="flex flex-col gap-4">
                <input type="text" name="first_name" placeholder="Vorname" class="p-2 rounded-lg" required>
                <input type="text" name="last_name" placeholder="Nachname" class="p-2 rounded-lg" required>
                <input type="email" name="email" placeholder="E-Mail-Adresse" class="p-2 rounded-lg" required>
                <input type="text" name="phone" placeholder="Telefonnummer" class="p-2 rounded-lg" required>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Benutzer erstellen</button>
            </form>
        </div>
        <a href="index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Zurück zur Startseite</a>
    </section>
</body>
</html>
<?php

require_once 'config.php';

// Check if the user ID is provided
if (!isset($_GET['customer_id'])) {
    echo 'Kunden-ID nicht gefunden!';
    exit;
}

// Get the user ID from the URL
$id = $_GET['customer_id'];

// Get the user from the database
try {
    $sql = 'SELECT * FROM customers WHERE customer_id = :customer_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['customer_id' => $id]);
    $user = $stmt->fetch();
} catch (Exception $e) {
    echo 'Fehler beim Abrufen des Benutzers: ' . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kunden bearbeiten</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="container mx-auto p-4 flex flex-col items-center gap-4 bg-gray-100 text-center rounded-lg shadow-lg mt-8">
        <h1 class="text-4xl">Kunden bearbeiten</h1>
        <p>Bearbeiten Sie den Kunden.</p>
        <div class="flex gap-4">
            <form action="update.php" method="post" class="flex flex-col gap-4">
                <input type="hidden" name="customer_id" value="<?php echo $user['customer_id']; ?>">
                <input type="text" name="first_name" placeholder="Vorname" class="p-2 rounded-lg" required value="<?php echo $user['first_name']; ?>">
                <input type="text" name="last_name" placeholder="Nachname" class="p-2 rounded-lg" required value="<?php echo $user['last_name']; ?>">
                <input type="email" name="email" placeholder="E-Mail-Adresse" class="p-2 rounded-lg" required value="<?php echo $user['email']; ?>">
                <input type="text" name="phone" placeholder="Telefonnummer" class="p-2 rounded-lg" required value="<?php echo $user['phone']; ?>">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kunden editieren</button>
            </form>
        </div>
        <a href="show.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Zurück zur Benutzerübersicht</a>
    </section>
</body>
</html>
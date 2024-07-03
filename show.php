<?php

require_once 'config.php';

// Get all users from the database
try {
    $sql = 'SELECT * FROM customers';
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll();
} catch (Exception $e) {
    echo 'Fehler beim Abrufen der Benutzer: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer Anzeigen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="container mx-auto p-4 flex flex-col items-center gap-4 bg-gray-100 text-center rounded-lg shadow-lg mt-8">
        <h1 class="text-4xl">Benutzer anzeigen</h1>
        <p>Übersicht aller Benutzer.</p>
        <div class="flex gap-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Vorname</th>
                        <th class="px-4 py-2">Nachname</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Telefonnummer</th>
                        <th class="px-4 py-2">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $user['customer_id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $user['first_name']; ?></td>
                            <td class="border px-4 py-2"><?php echo $user['last_name']; ?></td>
                            <td class="border px-4 py-2"><?php echo $user['email']; ?></td>
                            <td class="border px-4 py-2"><?php echo $user['phone']; ?></td>
                            <td class="border px-4 py-2">
                                <a href="edit_customer.php?customer_id=<?php echo $user['customer_id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Bearbeiten</a>
                                <a href="delete.php?customer_id=<?php echo $user['customer_id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Löschen</a>
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
<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];

    if (empty($query)) {
        echo 'Keine eingabe';
    }

    $sql = 'SELECT * FROM customers WHERE first_name LIKE :query';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['query' => '%'.$query.'%']);
    $result = $stmt->fetchAll();

    if (!$result)
    {
        echo "not found";
    }

    foreach ($result as $row) {
        echo $row['first_name'] . '<br/>';
    }
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

<form action="search.php" method="post">
    </br>
    <a href="search.php"></a>
    <input type="text" name="query" placeholder="Vornamen eingeben..." />
    <button type="submit">Suchen</button> 
</form>
    <section class="container mx-auto p-4 flex flex-col items-center gap-4 bg-gray-100 text-center rounded-lg shadow-lg mt-8">
        <div class="flex gap-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Vorname</th>
                        <th class="px-4 py-2">Nachname</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Telefonnummer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($result) && is_array($result)) : ?>
                    <?php foreach ($result as $row):?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $row['customer_id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['first_name']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['last_name']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['email']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['phone']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Zurück zur Startseite</a>
    </section>
</body>
</html>
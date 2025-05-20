<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>medewerkers Overzicht</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Overzicht medewerkers</h1>
<a class="btn btn-add" href="add.php">+ medewerker toevoegen</a>

<table>
    <tr>
        <th>ID</th>
        <th>Genruiker ID</th>
        <th>Relatienummer</th>
        <th>Actief</th>
        <th>Opmerking</th>
        <th>Aangemaakt</th>
        <th>Gewijzigd</th>
        <th>Acties</th>
    </tr>

<?php
$sql = "SELECT * FROM Bezoeker";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Id']}</td>
                <td>{$row['GebruikerId']}</td>
                <td>{$row['Relatienummer']}</td>
                <td>" . ($row['Isactief'] ? 'Ja' : 'Nee') . "</td>
                <td>{$row['Opmerking']}</td>
                <td>{$row['DatumAangemaakt']}</td>
                <td>{$row['DatumGewijzigd']}</td>
                <td>
                    <a class='btn btn-edit' href='edit.php?id={$row['Id']}'>Edit</a>
                    <a class='btn btn-delete' href='delete.php?id={$row['Id']}' onclick=\"return confirm('Weet je het zeker?');\">Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>Geen medewerkers gevonden.</td></tr>";
}
$conn->close();
?>
</table>
</body>
</html>

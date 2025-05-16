<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Overzicht Werknemers</title>
    <link rel="stylesheet" href="style.css">
    
    
</head>
<body>

<h1>Overzicht Werknemers</h1>

<a class="top-link" href="add.php">+ Nieuwe medewerker toevoegen</a>

<table>
    <tr>
        <th>Foto</th>
        <th>Naam</th>
        <th>Rol</th>
        <th>Acties</th>
    </tr>

    <?php
    $sql = "SELECT * FROM werknemers";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='" . htmlspecialchars($row['foto']) . "' alt='Foto'></td>";
            echo "<td>" . htmlspecialchars($row['naam']) . "</td>";
            echo "<td>" . htmlspecialchars($row['rol']) . "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-edit'>Edit</a>
                    <a href='delete.php?id=" . $row['id'] . "' class='btn btn-delete' onclick=\"return confirm('Weet je het zeker?');\">Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Geen medewerkers gevonden.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Medewerker Toevoegen</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<h1>Nieuwe Medewerker Toevoegen</h1>
<a href="index.php">← Terug naar overzicht</a>

<form action="" method="post" enctype="multipart/form-data">
    <table class="form-table">
        <tr>
            <td><label for="naam">Naam:</label></td>
            <td><input type="text" name="naam" id="naam" required></td>
        </tr>
        <tr>
            <td><label for="rol">Rol:</label></td>
            <td><input type="text" name="rol" id="rol" required></td>
        </tr>
        <tr>
            <td><label for="foto">Foto:</label></td>
            <td><input type="file" name="foto" id="foto"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <input type="submit" name="submit" value="Opslaan">
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $rol = $_POST['rol'];

    // Foto uploaden
    $fotoPath = '';
    if ($_FILES['foto']['name']) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        }

        $fotoPath = $uploadDir . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);
    }

    // Insert into DB
    $sql = "INSERT INTO werknemers (naam, rol, foto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $naam, $rol, $fotoPath);
    $stmt->execute();

    echo "<p class='success'>Medewerker toegevoegd!</p>";
}
?>
</body>
</html>

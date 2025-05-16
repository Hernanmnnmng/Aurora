<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Geen ID opgegeven.";
    exit;
}

$id = intval($_GET['id']);

// Haal bestaande data op
$sql = "SELECT * FROM werknemers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Medewerker niet gevonden.";
    exit;
}

$medewerker = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $rol = $_POST['rol'];

    // Foto upload verwerken
    $fotoPath = $medewerker['foto']; // standaard oude foto
    if (!empty($_FILES['foto']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        }

        $fotoPath = $uploadDir . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);
    }

    // Update query
    $updateSql = "UPDATE werknemers SET naam = ?, rol = ?, foto = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssi", $naam, $rol, $fotoPath, $id);
    $updateStmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medewerker Bewerken</title>
    <link rel="stylesheet" href="style.css">
   
</head>
<body>

<h1>Medewerker Bewerken</h1>
<a href="index.php">← Terug naar overzicht</a>

<form action="" method="post" enctype="multipart/form-data">
    <label for="naam">Naam:</label>
    <input type="text" name="naam" id="naam" required value="<?php echo htmlspecialchars($medewerker['naam']); ?>">

    <label for="rol">Rol:</label>
    <input type="text" name="rol" id="rol" required value="<?php echo htmlspecialchars($medewerker['rol']); ?>">

    <label for="foto">Foto wijzigen (optioneel):</label>
    <input type="file" name="foto" id="foto">

    <?php if (!empty($medewerker['foto']) && file_exists($medewerker['foto'])): ?>
        <div class="current-photo">
            <strong>Huidige foto:</strong><br>
            <img src="<?php echo htmlspecialchars($medewerker['foto']); ?>" alt="Huidige foto">
        </div>
    <?php endif; ?>

    <input type="submit" name="submit" value="Opslaan">
</form>

</body>
</html>

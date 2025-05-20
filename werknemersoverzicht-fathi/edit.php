<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Bezoeker WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$bezoeker = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikerId = $_POST['gebruikerid'];
    $relatie = $_POST['relatienummer'];
    $isactief = isset($_POST['isactief']) ? 1 : 0;
    $opmerking = $_POST['opmerking'];
    $now = date("Y-m-d H:i:s.u");

    $sql = "UPDATE Bezoeker SET 
                GebruikerId=?, 
                Relatienummer=?, 
                Isactief=?, 
                Opmerking=?, 
                DatumGewijzigd=?
            WHERE Id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiissi", $gebruikerId, $relatie, $isactief, $opmerking, $now, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<form method="post">
    <label>Gebruiker ID: <input type="number" name="gebruikerid" value="<?= $bezoeker['GebruikerId'] ?>" required></label><br>
    <label>Relatienummer: <input type="number" name="relatienummer" value="<?= $bezoeker['Relatienummer'] ?>" required></label><br>
    <label>Actief: <input type="checkbox" name="isactief" <?= $bezoeker['Isactief'] ? 'checked' : '' ?>></label><br>
    <label>Opmerking: <input type="text" name="opmerking" value="<?= $bezoeker['Opmerking'] ?>"></label><br>
    <button type="submit">Opslaan</button>
</form>

<?php include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikerId = $_POST['gebruikerid'];
    $relatie = $_POST['relatienummer'];
    $isactief = isset($_POST['isactief']) ? 1 : 0;
    $opmerking = $_POST['opmerking'];
    $now = date("Y-m-d H:i:s.u");

    $sql = "INSERT INTO Bezoeker (GebruikerId, Relatienummer, Isactief, Opmerking, DatumAangemaakt, DatumGewijzigd)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiisss", $gebruikerId, $relatie, $isactief, $opmerking, $now, $now);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<form method="post">
    <label>Gebruiker ID: <input type="number" name="gebruikerid" required></label><br>
    <label>Relatienummer: <input type="number" name="relatienummer" required></label><br>
    <label>Actief: <input type="checkbox" name="isactief"></label><br>
    <label>Opmerking: <input type="text" name="opmerking"></label><br>
    <button type="submit">Toevoegen</button>
</form>


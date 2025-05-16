<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete record from DB
    $sql = "DELETE FROM werknemers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirect back to index
    header("Location: index.php");
    exit;
} else {
    echo "Geen ID opgegeven.";
}
?>

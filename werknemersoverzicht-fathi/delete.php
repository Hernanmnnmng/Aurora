<?php
include 'db.php';
$id = $_GET['id'];

$sql = "DELETE FROM Bezoeker WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit;
?>

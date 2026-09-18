<?php
include "db.php";

if (!isset($_GET["id"])) {
    header("Location: jobs.php");
    exit();
}

$id = $_GET["id"];

$sql = "DELETE FROM jobs WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: jobs.php?deleted=1");
    exit();
} else {
    echo "Error deleting job: " . $conn->error;
}

$stmt->close();
?>
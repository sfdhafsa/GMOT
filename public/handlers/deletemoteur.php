<?php
session_start();
require __DIR__ . '/../../config/db_conn.php';

// Check login
if (!isset($_SESSION['ID_RESPO'])) {
    header("Location: ../index.php?error=Veuillez vous connecter");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['motors'])) {
    $motors = json_decode($_POST['motors'], true);

    if (!is_array($motors)) {
        die("Format incorrect des moteurs.");
    }

    // Prepare DELETE statement
    $in  = str_repeat('?,', count($motors) - 1) . '?';
    $sql = "DELETE FROM MOTEUR WHERE MATRICULE_MOT IN ($in)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute($motors);
       header("Location: /GMOT/public/home.php?deleted=1"); 
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression: " . $e->getMessage());
    }
} else {
    header("Location: ../home.php?error=Aucun moteur sélectionné");
    exit();
}

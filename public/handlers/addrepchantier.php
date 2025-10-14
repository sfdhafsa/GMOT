<?php
session_start();
require __DIR__ . '/../../config/db_conn.php';

// Ensure user is logged in and motor ID exists
if (!isset($_SESSION['ID_RESPO']) || !isset($_SESSION['LAST_MOTOR_ID'])) {
    header("Location: ../index.php?error=Veuillez vous connecter");
    exit();
}

$last_motor_id = $_SESSION['LAST_MOTOR_ID'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $libelle_chantier = $_POST['Libelle_chantier'];
    $libelle_repere = $_POST['Libelle_repere'];
    $descr_repere = $_POST['Descr_repere'];

    //  Insert Chantier
    $sqlChantier = "INSERT INTO CHANTIER (LIBEL_CHANT) VALUES (:libelle_chantier)";
    $stmt = $conn->prepare($sqlChantier);
    $stmt->bindParam(':libelle_chantier', $libelle_chantier, PDO::PARAM_STR);
    $stmt->execute();
    $id_chantier = $conn->lastInsertId();

    //  Insert Repère
    $sqlRepere = "INSERT INTO REPERE (ID_CHANT, LIBELLE_REP, DESC_REP) 
                  VALUES (:id_chantier, :libelle_repere, :descr_repere)";
    $stmt = $conn->prepare($sqlRepere);
    $stmt->bindParam(':id_chantier', $id_chantier, PDO::PARAM_INT);
    $stmt->bindParam(':libelle_repere', $libelle_repere, PDO::PARAM_STR);
    $stmt->bindParam(':descr_repere', $descr_repere, PDO::PARAM_STR);
    $stmt->execute();
    $id_repere = $conn->lastInsertId();

    //  Update motor with the new ID_REP
    $sqlUpdateMotor = "UPDATE MOTEUR SET ID_REP = :id_repere WHERE ID_MOT = :last_motor_id";
    $stmt = $conn->prepare($sqlUpdateMotor);
    $stmt->bindParam(':id_repere', $id_repere, PDO::PARAM_INT);
    $stmt->bindParam(':last_motor_id', $last_motor_id, PDO::PARAM_INT);
    $stmt->execute();

    // Success message and redirect to home
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            swal('Succès', 'Moteur ajouté avec succès!', 'success').then(() => {
                window.location.href = '/GMOT/public/home.php';
            });
        });
    </script>";

    // Clear last motor ID from session
   
    unset($_SESSION['LAST_MOTOR_ID']);
}
?>

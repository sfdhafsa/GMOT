<?php
session_start();
require __DIR__ . '/../../config/db_conn.php';

// Ensure user is logged in
if (!isset($_SESSION['ID_RESPO'])) {
    header("Location: ../index.php?error=Veuillez vous connecter");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_respo = $_SESSION['ID_RESPO'];

    try {
        // Prepare the SQL insert statement (excluding ID_REP)
        $sql = "INSERT INTO MOTEUR (
                    MATRICULE_MOT,
                    NUM_SERVICE,
                    TYPE_,
                    MARQUE,
                    PUISSANCE,
                    COURANT_MIN,
                    VITESSE_,
                    TENSION,
                    COUPLAGE_,
                    FORME_,
                    ETAT_MOT,
                    REPARE,
                    TYPE_REP,
                    ENTREPRISE_REP,
                    DATE_ENVOI_REP,
                    DATE_RECEP,
                    ID_RESPO
                ) VALUES (
                    :matricule,
                    :num_service,
                    :type,
                    :marque,
                    :puissance,
                    :courant_min,
                    :vitesse,
                    :tension,
                    :couplage,
                    :forme,
                    :etat_mot,
                    :repare,
                    :type_rep,
                    :entreprise_rep,
                    :date_envoi_rep,
                    :date_recep_rep,
                    :id_respo
                )";

        $stmt = $conn->prepare($sql);

        // Bind parameters safely
        $stmt->execute([
            ':matricule'       => $_POST['matricule'] ?? null,
            ':num_service'     => $_POST['num_service'] ?? null,
            ':type'            => $_POST['Type'] ?? null,
            ':marque'          => $_POST['marque'] ?? null,
            ':puissance'       => $_POST['Puissance'] ?? null,
            ':courant_min'     => $_POST['Courant_min'] ?? null,
            ':vitesse'         => $_POST['Vitesse'] ?? null,
            ':tension'         => $_POST['Tension'] ?? null,
            ':couplage'        => $_POST['Couplage'] ?? null,
            ':forme'           => $_POST['Forme'] ?? null,
            ':etat_mot'        => $_POST['etat_mot'] ?? null,
            ':repare'          => $_POST['repare'] ?? null,
            ':type_rep'        => $_POST['type_rep'] ?? null,
            ':entreprise_rep'  => $_POST['entreprise_rep'] ?? null,
            ':date_envoi_rep'  => !empty($_POST['Date_envoi_rep']) ? $_POST['Date_envoi_rep'] : null,
            ':date_recep_rep'  => !empty($_POST['Date_recep_rep']) ? $_POST['Date_recep_rep'] : null,
            ':id_respo'        => $id_respo
        ]);

        // Retrieve the newly inserted motor ID
        $last_motor_id = $conn->lastInsertId();
        $_SESSION['LAST_MOTOR_ID'] = $last_motor_id;

        // Redirect to add repère/chantier form
        header("Location: ../handlers/formaddrepchant.php");
        exit();

    } catch (PDOException $e) {
        // Log or show error
        die("Erreur lors de l'ajout du moteur : " . $e->getMessage());
    }

} else {
    header("Location: /GMOT/public/home.php?success=1");
    exit();
}
?>

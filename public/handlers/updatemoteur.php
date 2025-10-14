<?php
session_start();
require __DIR__ . '/../../config/db_conn.php';

// Vérifier la session
if (!isset($_SESSION['ID_RESPO'])) {
    header("Location: ../index.php?error=Veuillez vous connecter");
    exit();
}

// Vérifier si le formulaire est bien envoyé
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $matricule = $_POST['matricule'];

    // Sécurisation des champs
    $num_service = $_POST['num_service'] ?? null;
    $type = $_POST['Type'] ?? null;
    $marque = $_POST['marque'] ?? null;
    $puissance = $_POST['Puissance'] ?? null;
    $courant_min = $_POST['Courant_min'] ?? null;
    $vitesse = $_POST['Vitesse'] ?? null;
    $tension = $_POST['Tension'] ?? null;
    $couplage = $_POST['Couplage'] ?? null;
    $forme = $_POST['Forme'] ?? null;
    $etat_mot = $_POST['etat_mot'] ?? null;
    $repare = $_POST['repare'] ?? null;
    $type_rep = $_POST['type_rep'] ?? null;
    $entreprise_rep = $_POST['entreprise_rep'] ?? null;
    $date_envoi = $_POST['Date_envoi_rep'] ?? null;
    $date_recep = $_POST['Date_recep_rep'] ?? null;

    try {
        $sql = "UPDATE MOTEUR 
                SET 
                    NUM_SERVICE = :num_service,
                    TYPE_ = :type,
                    MARQUE = :marque,
                    PUISSANCE = :puissance,
                    COURANT_MIN = :courant_min,
                    VITESSE_ = :vitesse,
                    TENSION = :tension,
                    COUPLAGE_ = :couplage,
                    FORME_ = :forme,
                    ETAT_MOT = :etat_mot,
                    REPARE = :repare,
                    TYPE_REP = :type_rep,
                    ENTREPRISE_REP = :entreprise_rep,
                    DATE_ENVOI_REP = :date_envoi,
                    DATE_RECEP = :date_recep
                WHERE MATRICULE_MOT = :matricule";

        $stmt = $conn->prepare($sql);
        $success = $stmt->execute([
            ':num_service' => $num_service,
            ':type' => $type,
            ':marque' => $marque,
            ':puissance' => $puissance,
            ':courant_min' => $courant_min,
            ':vitesse' => $vitesse,
            ':tension' => $tension,
            ':couplage' => $couplage,
            ':forme' => $forme,
            ':etat_mot' => $etat_mot,
            ':repare' => $repare,
            ':type_rep' => $type_rep,
            ':entreprise_rep' => $entreprise_rep,
            ':date_envoi' => $date_envoi,
            ':date_recep' => $date_recep,
            ':matricule' => $matricule
        ]);

        if ($success) {
            // Redirection après succès
            header("Location: /GMOT/public/home.php?updated=1");
              // Success message and redirect to home
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            swal('Succès', 'Moteur ajouté avec succès!', 'success').then(() => {
                                window.location.href = '/GMOT/public/home.php';
                            });
                        });
                    </script>";
                            exit();
        } else {
            echo "Erreur lors de la mise à jour du moteur.";
        }

    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
  
} else {
    header("Location: ../home.php");
    exit();
}
?>

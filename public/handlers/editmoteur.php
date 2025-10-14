<?php 
include_once __DIR__ . '../../../includes/header.php';
require __DIR__ . '/../../config/db_conn.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION['ID_RESPO'])) {
    header("Location: ../index.php?error=Veuillez vous connecter");
    exit();
}

// Get the motor matricule from GET
if (!isset($_GET['matricule'])) {
    die("Aucun moteur sélectionné.");
}

$matricule = $_GET['matricule'];

// Fetch motor data
$stmt = $conn->prepare("SELECT * FROM MOTEUR WHERE MATRICULE_MOT = ?");
$stmt->execute([$matricule]);
$motor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$motor) {
    die("Moteur introuvable.");
}
?>

<section id="formscontainer">
<section class="addformcontainer">
   <h1 class="addformtitle">Modifier moteur: <?php echo htmlspecialchars($motor['MATRICULE_MOT']); ?></h1>
    <form id="editform"  action="/GMOT/public/handlers/updatemoteur.php" method="post" autocomplete="off">
        <!-- Hidden input to identify motor -->
        <input type="hidden" name="matricule" value="<?php echo htmlspecialchars($motor['MATRICULE_MOT']); ?>">

        <div class="container_input">
            <div class="input_group">
                <label for="num_service">Numéro de service:</label> 
                <input type="text" id="num_service" name="num_service" value="<?php echo htmlspecialchars($motor['NUM_SERVICE']); ?>" required> 
            </div>
            <div class="input_group">
                <label for="Type">Type:</label> 
                <input type="text" id="Type" name="Type" value="<?php echo htmlspecialchars($motor['TYPE_']); ?>">
            </div>
        </div>

        <div class="container_input">
            <div class="input_group">
                <label for="marque">Marque:</label>
                <select id="marque" name="marque">
                    <?php
                    $brands = ["ABB","SIEMENS","LEROY","WEG","J.SCHNEIDER","LEROY SOMER","SEW-EURODRIVE","ASEA","BAUER","ZEW","VEM","SMEM","MEIDINGER SA","FACQUET","VELA","ELECTRO ADDA","UNELEC","MEIDIN","KULI","SWF","SASEMI-GAMAR","MOTOVARIO","WAM"];
                    foreach ($brands as $brand) {
                        $selected = ($brand === $motor['MARQUE']) ? 'selected' : '';
                        echo "<option value=\"$brand\" $selected>$brand</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input_group">
                <label for="Puissance">Puissance:</label> 
                <input type="text" id="Puissance" name="Puissance" value="<?php echo htmlspecialchars($motor['PUISSANCE']); ?>" required>
            </div>
        </div>

        <div class="container_input">
            <div class="input_group">
                <label for="Courant_min">Courant minimal:</label> 
                <input type="text" id="Courant_min" name="Courant_min" value="<?php echo htmlspecialchars($motor['COURANT_MIN']); ?>" required>
            </div>
            <div class="input_group">
                <label for="Vitesse">Vitesse:</label>   
                <input type="text" id="Vitesse" name="Vitesse" value="<?php echo htmlspecialchars($motor['VITESSE_']); ?>" required>
            </div>
        </div>

        <div class="container_input">
            <div class="input_group">
                <label for="Tension">Tension:</label> 
                <input type="text" id="Tension" name="Tension" value="<?php echo htmlspecialchars($motor['TENSION']); ?>" required>
            </div>
        </div>
        <div class="input_group">
            <label for="Couplage">Couplage:</label>
            <div class="radio-group">
                <input type="radio" id="D" name="Couplage" value="D">
                <label for="D">D</label>

                <input type="radio" id="Y" name="Couplage" value="Y">
                <label for="Y">Y</label>
            </div>
        </div>
        <div class="container_input">
            <div class="input_group">
                <label for="Forme">Forme:</label>
                <select name="Forme">
                    <?php
                    $formes = ["B3","B6","B7","B8","B5","B14","B34","B35","V1","V5","V18","V15","V6","V3","V19","V36"];
                    foreach($formes as $f){
                        $selected = ($f === $motor['FORME_']) ? 'selected' : '';
                        echo "<option value=\"$f\" $selected>$f</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input_group">
                <label for="etat_mot">Etat du moteur:</label>
                <select name="etat_mot">
                    <?php
                    $states = ["En stock","En panne","En réparation","En service"];
                    foreach($states as $s){
                        $selected = ($s === $motor['ETAT_MOT']) ? 'selected' : '';
                        echo "<option value=\"$s\" $selected>$s</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="container_input">
            <div class="input_group">
                <label for="repare">Moteur réparé:</label>
                <select name="repare">
                    <?php
                    $options = ["Oui","NON","En cours de réparation"];
                    foreach($options as $o){
                        $selected = ($o === $motor['REPARE']) ? 'selected' : '';
                        echo "<option value=\"$o\" $selected>$o</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input_group">
                <label for="type_rep">Type de réparation:</label>
                <select name="type_rep">
                    <?php
                    $types = ["Rebobinage","Révision","Aucune réparation","Autre"];
                    foreach($types as $t){
                        $selected = ($t === $motor['TYPE_REP']) ? 'selected' : '';
                        echo "<option value=\"$t\" $selected>$t</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <label for="entreprise_rep">Entreprise de réparation:</label>
        <input type="text" class="single_input" id="entreprise_rep" name="entreprise_rep" value="<?php echo htmlspecialchars($motor['ENTREPRISE_REP']); ?>">

        <div class="container_input">
            <div class="input_group">
                <label for="Date_envoi_rep">Date d'envoi en réparation:</label>
                <input type="date" name="Date_envoi_rep" value="<?php echo htmlspecialchars($motor['DATE_ENVOI_REP']); ?>">
            </div>
            <div class="input_group">
                <label for="Date_recep_rep">Date de réception:</label>
                <input type="date" name="Date_recep_rep" value="<?php echo htmlspecialchars($motor['DATE_RECEP']); ?>">
            </div>
        </div>

        <br>
        <input class="addinput" type="submit" value="Modifier">

    </form>
</section>
</section>
</body>
</html>

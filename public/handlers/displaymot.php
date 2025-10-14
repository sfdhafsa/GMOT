<?php
session_start(); // Start the session to access session variables

if (isset($_SESSION['fetched_data'])) {
    $fetchedData = $_SESSION['fetched_data'];
    // Access individual fields
    $matricule = $fetchedData['MATRICULE_MOT'];
    $id_rep=$fetchedData['ID_REP'];
    $numservice=$fetchedData['NUM_SERVICE'];
    $type=$fetchedData['TYPE_'];
    $marque=$fetchedData['MARQUE'];
    $puissance=$fetchedData['PUISSANCE'];
    $courant_min=$fetchedData['COURANT_MIN'];
    $vitesse=$fetchedData['VITESSE_'];
    $tension=$fetchedData['TENSION'];
    $couplage=$fetchedData['COUPLAGE_'];
    $forme=$fetchedData['FORME_'];
    $etat_mot=$fetchedData['ETAT_MOT'];
    $repare=$fetchedData['REPARE'];
    $type_rep=$fetchedData['TYPE_REP'];
    $entreprise_rep=$fetchedData['ENTREPRISE_REP'];
    $date_envoi_rep=$fetchedData['DATE_ENVOI_REP'];
    $date_recep_rep=$fetchedData['DATE_RECEP'];
    ?>
<?php 
  include_once __DIR__ . '/../../includes/header.php';
?>
    <section id="displaymotcontainer">
        <div class="info">
            <h1 class="typeinfo">informations sur le moteur:</h1>
            <div class="groupcontain">
                <span class="fieldname">Matricule:</span>
                <span class="value"> <?php echo $matricule; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Numéro de service:</span>
                <span class="value"> <?php echo $numservice; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Type:</span>
                <span class="value"> <?php if($type==null){echo'_';}else{echo $type;} ; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Marque:</span>
                <span class="value"> <?php echo $marque; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Puissance:</span>
                <span class="value"> <?php echo $puissance.'kw'; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Courant minimal:</span>
                <span class="value"> <?php echo $courant_min.'A'; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Vitesse:</span>
                <span class="value"> <?php echo $vitesse.'tr/min'; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Tension:</span>
                <span class="value"> <?php echo $tension.'V'; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Couplage:</span>
                <span class="value"> <?php echo $couplage; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Forme:</span>
                <span class="value"> <?php echo $forme; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Etat du moteur :</span>
                <span class="value"> <?php echo $etat_mot; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Moteur réparé:</span>
                <span class="value"> <?php echo $repare; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">TYPE_REP:</span>
                <span class="value"> <?php echo $type_rep; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Entreprise de reparation:</span>
                <span class="value"> <?php if($entreprise_rep==null){echo'_';}else{echo $entreprise_rep;} ; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">Moteur envoyé au reparation le:</span>
                <span class="value"> <?php if($date_envoi_rep==null){echo'_';}else{echo $date_envoi_rep;} ; ?></span>
            </div>
            <div class="groupcontain">
                <span class="fieldname">reçu le:</span>
                <span class="value"> <?php if($date_recep_rep==null){echo'_';}else{echo $date_recep_rep;} ; ?></span>
            </div>

        </div>
    
        <?php
            if ($fetchedData['ID_REP']!= null) {
                require __DIR__ . '/../../config/db_conn.php';
                $pdo=$conn;
                $query = " SELECT * from repere where ID_REP=:id_rep;";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_rep', $id_rep, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_chant=$result['ID_CHANT'];
                $desc_rep=$result['DESC_REP'];
                ?>
                <h1 class="typeinfo">Informations sur le repère:</h1>
                <div id="info">
                    <div class="groupcontain" class="rep&chant">
                        <span class="fieldname">Libellée:</span>
                        <span class="value"> <?php echo $result['LIBELLE_REP']; ?></span> 
                    </div>
                    <div class="groupcontain" class="rep&chant">
                        <span class="fieldname">Description du repère:</span>
                        <span class="value"> <?php if($desc_rep==null){echo'aucune description valable';}else{echo $desc_rep;} ; ?></span>
                    </div>

                </div>
                <?php
                   $query = " SELECT * from chantier where ID_CHANT=:id_chant;";
                   $stmt = $pdo->prepare($query);
                   $stmt->bindParam(':id_chant', $id_chant, PDO::PARAM_INT);
                   $stmt->execute();
                   $result = $stmt->fetch(PDO::FETCH_ASSOC);
                   ?>
                   <div class="info">
                        <h1 class="typeinfo">Informations sur le chantier:</h1>
                        <div class="groupcontain">
                                <span class="fieldname">Libellée:</span>
                                <span class="value"> <?php echo $result['LIBEL_CHANT']; ?></span> 
                        </div>
                   </div>

                <?php
            };
        ?>
      

    </section>

<?php
} else {
   echo 'error: moteur introuvable';
}

?>
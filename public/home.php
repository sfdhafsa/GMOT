<?php 
   
    session_start();

    if(isset($_SESSION['ID_RESPO']) && isset($_SESSION['USER_NAME'])){
       include_once __DIR__ . '/../includes/header.php';
    
?>
       
        
        <div id="logedusercontain">
            <h1 id="bonjouruser">Bonjour M.<?php echo $_SESSION['USER_NAME']; ?></h1>
            <a id="logout" href="./pages/auth/logout.php">se déconnecter</a>
        </div>

        <section id="sidebar">
            <div id="sbcontainer">
                <div class="sba">
                    <a  href="/GMOT/public/handlers/addformmoteur.php"><img class="sblogos" src="./assets/images/addwb.png" alt="ajouter un moteur"></a>
                </div>
                <div class="sba">
                    <a id="editMoteur" href="/GMOT/public/handlers/editmoteur.php"><img class="sblogos" src="./assets/images/editwb.png" alt="modifier fiche technique d'un moteur"></a>
                </div>
                <div class="sba">
                    <a id="deleteMoteur" href="/GMOT/public/handlers/deletemoteur.php"><img class="sblogos" src="./assets/images/deletewb.png" alt="supprimer un moteur"></a>
                </div>
            </div>

        </section>

        <?php 
            require __DIR__ . '/../config/db_conn.php';
            $pdo=$conn;
            $query = " SELECT * from moteur;";

            // Use prepared statements to update the Moteur record
            $stmt = $pdo->query($query);
            

            ?>
            <section id="display_content">

                <?php
            foreach($stmt->fetchAll() as $row){
                 $matricule=$row["MATRICULE_MOT"];
                ?>
               <div class="moteurcard" data-matricule="<?php echo $matricule; ?>"  style="cursor: pointer; position: relative;">
                        <input type="checkbox" class="moteur-checkbox" value="<?php echo $matricule; ?>">
                        <img class="moteurimage" src="./assets/images/moteurimage.jpeg">
                        <div class="moteurinfo">
                            <p style="font-weight:bold;font-size:large;"><?php echo $matricule; ?></p>
                            <?php echo $row["ETAT_MOT"]; ?>
                        </div>
                </div>
                <?php 
            }
            ?>
            </section>
            
       
            <script src="/GMOT/public/assets/js/moteurAction.js" defer></script>
            <?php if (isset($_GET['success']) || isset($_GET['updated']) || isset($_GET['deleted'])): ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        <?php if (isset($_GET['success'])): ?>
                            swal('Succès', 'Moteur ajouté avec succès !', 'success');
                        <?php elseif (isset($_GET['updated'])): ?>
                            swal('Succès', 'Moteur modifié avec succès !', 'success');
                        <?php elseif (isset($_GET['deleted'])): ?>
                            swal('Supprimé', 'Moteur supprimé avec succès !', 'success');
                        <?php endif; ?>
                    });
                </script>
            <?php endif; ?>

        
    </body>
</html>

<?php
}else{
    header("location:index.php");
    exit();
}


?>
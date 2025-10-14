<?php 
     include_once __DIR__ . '../../../includes/header.php';
?>
<section id="formscontainer" >
<section class="addformcontainer"> 
   <h1 class="addformtitle" >Ajouter moteur:</h1> 
    <form id="addform"  action="/GMOT/public/handlers/addmoteur.php" method="post" autocomplete="off">
        <div class="container_input">
            <div class="input_group">
            <label for="matricule">Matricule:</label> 
            <input type="text" id="matricule" name="matricule" placeholder="Matricule" required> 
            </div>
            <div class="input_group">
            <label for="num_service">Numéro de service:</label> 
            <input type="text" id="num_service" name="num_service" placeholder="Numéro de service" required> 
            </div>
        </div>
        <br>
        <div class="container_input">
         <div class="input_group">
            <label for="Type">Type:</label> 
            <input type="text" id="Type" name="Type" placeholder="Type" >
         </div>
         <div class="input_group">
            <div class="select_label" >
                <label for="marque">Marque:</label>
                <select id="marque" name="marque">
                    <option>ABB</option>
                    <option>SIEMENS</option>
                    <option>LEROY</option>
                    <option>WEG</option>
                    <option>J.SCHNEIDER</option>
                    <option>LEROY SOMER</option>
                    <option>SEW-EURODRIVE</option>
                    <option>ASEA</option>
                    <option>BAUER</option>
                    <option>ZEW</option>
                    <option>VEM</option>
                    <option>SMEM</option>
                    <option>MEIDINGER SA</option>
                    <option>FACQUET</option>
                    <option>VELA</option>
                    <option>ELECTRO ADDA</option>
                    <option>UNELEC</option>
                    <option>MEIDIN</option>
                    <option>KULI</option>
                    <option>SWF</option>
                    <option>SASEMI-GAMAR</option>
                    <option>MOTOVARIO</option>
                    <option>WAM</option>
                </select>
            </div>
         </div>
        </div>
        <div class="container_input">
        <div class="input_group">
        <label for="Puissance">Puissance:</label> 
        <input type="text" id="Puissance" name="Puissance" placeholder="Puissance" required>
        </div>
        <div class= "input_group">
        <label for="Courant_minimal">Courant minimal:</label> 
        <input type="text" id="Courant minimal" name="Courant_min" placeholder="Courant minimal" required><br> 
        </div>
        </div>
        <div class="container_input">
        <div class="input_group"> 
            <label for="Vitesse">Vitesse:</label>   
            <input type="text" id="Vitesse" name="Vitesse" placeholder="Vitesse" required> <br>
        </div>
        <div class="input_group">
            <label for="Tension">Tension:</label> 
            <input type="text" id="Tension" name="Tension" placeholder="Tension" required><br> 
        </div>
        </div>
        <div class="container_input">
            <label for="Couplage">Couplage:</label>
                <br>
            <input type="radio" id="D" name="Couplage" value="D" >
            <label for="D">D</label>
            <input type="radio" id="Y" name="Couplage" value="Y">
            <label for="Y">Y</label><br>
        </div>
           <div class="container_input">
           <div class="input_group">
                <label for="Forme" >Forme:</label>
                    <select name="Forme">
                        <option>B3</option>
                        <option>B6</option>
                        <option>B7</option>
                        <option>B8</option>
                        <option>B5</option>
                        <option>B14</option>
                        <option>B34</option>
                        <option>B35</option>
                        <option>V1</option>
                        <option>V5</option>
                        <option>V18</option>
                        <option>V15</option>
                        <option>V6</option>
                        <option>V3</option>
                        <option>V19</option>
                        <option>V36</option>
                    </select>
           </div>
           <div class="input_group">
        <label for="etat_moteur">Etat du moteur:</label>
        <select name="etat_mot">
            <option>En stock</option>
            <option>En panne</option>
            <option>En réparation</option>
            <option>En service</option>
        </select>
         </div>
        </div>
        <div class="container_input">
         <div class="input_group">
            <label for="repare">Moteur réparé:</label>
            <select name="repare">
                <option>Oui</option>
                <option>NON</option>
                <option>En cours de réparation</option>
            </select> 
        </div>
        <div class="input_group">
        <label for="type_rep">Type de réparation:</label>
            <select name="type_rep">
                <option>Rebobinage</option>
                <option>Révision</option>
                <option>Aucune réparation</option>
                <option>Autre</option>
            </select> 
         </div> 
        </div>
        
            <label for= "entreprise_rep" class="single_label" >Entreprise de réparation:</label>
            <br>
            <input type="text" class="single_input" id="entreprise_rep" name="entreprise_rep" placeholder="Entreprise de réaparation"> 
       
        <div class="container_input">
        <div class="input_group">
        <label for="Date_envoi_rep">Date d'envoi en reparation: </label>
        <input type="Date" id="Date_envoi_rep" name="Date_envoi_rep"> 
        </div>
        <div class="input_group">
        <label for="Date_reception_rep">Date de reception:</label>
        <input type="Date" id="Date_reception_rep" name="Date_recep_rep"> 
        </div>
        </div>
        <br>
        <input class="addinput" type="submit" value="Ajouter">
        
    </form>
</section>  


</section>



</body>

</html>





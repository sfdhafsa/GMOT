<?php 
         include_once __DIR__ . '/../../includes/header.php';
?>
<section id="formscontainer"  >
<section class="addformcontainer">  
<div>
        <hr class="horizontal_line">
        <p id="message">Si le moteur est installé (en service) ajouter le repère et le chantier sinon dépasser cette phase.</p>
        <hr class="horizontal_line">
    </div> 
<br>
<a id="skip" href="/GMOT/public/home.php">Dépasser</a>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const skipLink = document.getElementById("skip");
    skipLink.addEventListener("click", function(event) {
        event.preventDefault();
        swal({
            title: "Succès",
            text: "Moteur ajouté avec succès!",
            icon: "success"
        }).then(() => {
            window.location.href = skipLink.getAttribute("href");
        });
    });
});
</script>

<form id="addrepere_rep_chantier"   action="addrepchantier.php" method="post">
     <div class="textadd">
        <h1 class="addformtitle">Ajouter chantier</h1>
     </div>
     <label for="Libelle_chantier" class="single_label">Libellé du chantier:</label>
     <input type="text" class="single_input" id="Libelle_chantier" name="Libelle_chantier" placeholder="chantier">
     <br>
     <div class="textadd">
     <h1 class="addformtitle">Ajouter repère </h1>
     </div>
     <label for="Libelle_repere" class="single_label">Libellé du repère:</label>
     <input type="text" class="single_input" id="Libelle_repere" name="Libelle_repere" placeholder="repère">
     <br>
     <label for="Descr_repere" class="single_label">Description du repère:</label>
     <br>
     <textarea  id="Descr_repere" name="Descr_repere" placeholder="ecrivez une description du repère(optionnel)"></textarea>
     <br>
    
      <input class="addinput" type="submit" value="Ajouter">
    
    </form>
</section>
</section>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the anchor element by its ID
    const skipLink = document.getElementById("skip");

    // Add a click event listener to the anchor
    skipLink.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default link behavior

        // Show SweetAlert popup
        swal({
            title: "succes",
            text: "Moteur ajouté avec succès!",
            icon: "success"
        }).then(() => {
    
                // Redirect to 'home.php'
                window.location.href = skipLink.getAttribute("href");
            
        });
    });
});
</script>
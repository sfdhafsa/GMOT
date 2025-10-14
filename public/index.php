<?php 
      include_once __DIR__ . '/../includes/header.php';
?>

<section id="interface">

       <section id="presentationcontainer">
        <div id="presentation">
            <h1  id="Bienvenue">Bienvenue dans GMOT! </h1>
            <br>
            <p class="textpresent">GMOT est un gestionnaire de stock des moteurs du MP1 </p>
            <br>
            <p  class="textpresent" >L'accès est permis uniquement aux agents de l'atelier électrique du MP1</p>
            <br>
            <p class="textpresent" >Connectez-vous pour y accéder</p>
            <br>
            
        </div>
       
       </section>

    
          <div id="logcontainer">
            <form id="connectform" action="pages/auth/login.php" method="post">
                <h2 id="cnx">CONNEXION</h2>
                <?php if(isset($_GET['error'])){?>
                    <p class="error"><?php echo $_GET['error'];?></p>
                <?php } ?>
                <br>
                <input type="text" name="uname" placeholder="Nom d'utilisateur">
                <br>
                <input type="password" name="password" placeholder="Mot de passe">
                <br>
                <button id ="connectbutton" type="submit"> se connecter</button>
            </form>
          </div>
         
</section>
<script>
    // Check if the page has been refreshed
    if (performance.navigation.type === 1) {
        // Page has been refreshed, redirect to index.php
        window.location.href = "index.php";
    }
</script>

    </body>
</html>
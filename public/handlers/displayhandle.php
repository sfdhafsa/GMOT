<?php

// Check if the 'matricule' parameter is set in the URL
if (isset($_GET['matricule'])) {
    // Retrieve the 'matricule' value from the URL
    $matricule = $_GET['matricule'];
    require __DIR__ . '/../../config/db_conn.php';
    $pdo=$conn;
    $query = "SELECT * FROM moteur WHERE Matricule_MOT = :matricule";
  // Prepare the statement
    $stmt = $pdo->prepare($query);

    // Bind the parameter as a string
    $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    session_start();
    if ($result) {
        $_SESSION['fetched_data'] = $result;
        /*print_r($_SESSION['fetched_data']);*/
        header('location:displaymot.php');
        // $result is an associative array containing the row's data
    } else {
        echo"aucun moteur correspondant";
    }
         
} else {
    // Handle the case where 'matricule' is not set in the URL
    echo "erreur.";
}

?>

<?php 
session_start();

require __DIR__ . '/../../../config/db_conn.php'; 

    $uname=$_POST['uname'];
    $pass=$_POST['password'];

    if(empty($uname)){
        header("location:index.php?error=Aucun nom d'utilisateur n'est saisi");
        exit();
    }
    if(empty($pass)){
        header("location:index.php?error=Aucun mot de passe n'est saisi");
        exit();
    }
       
// Create a PDO connection (assuming you have established the database connection)

try {
    $pdo = $conn;
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle the database connection error
    die("Database connection failed: " . $e->getMessage());
}

// Prepare and execute a SELECT query using PDO::query
$query = "SELECT USER_NAME, PASSWORD, ID_RESPO FROM responsable WHERE USER_NAME = :uname";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':uname', $uname, PDO::PARAM_STR);
$stmt->execute();

// Fetch a single row as an associative array
$row = $stmt->fetch(PDO::FETCH_ASSOC);


if ($row) {
    // A row was found in the database
    if ($row['PASSWORD'] === $pass) {
        // Password matches
        $_SESSION['USER_NAME'] = $row['USER_NAME'];
        $_SESSION['ID_RESPO'] = $row['ID_RESPO'];
        header("Location: /GMOT/public/home.php");
        exit();
    } else {
        // Password does not match
        header("location:index.php?error=mot de passe incorrect");
        exit();
    }
} else {
    // No matching row found in the database
    header("location:index.php?error=nom d'utilisateur incorrect");
    exit();
}
    
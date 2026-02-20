<?php
require_once '../config/db.php';
 session_start();

 $id_user = $_SESSION['user_id'];

if (isset($_POST['ajouter_rappel'])) {
    $type = htmlspecialchars($_POST['type_rappel']);
    $titre = htmlspecialchars($_POST['titre']);
    $date_rappel = $_POST['date_rappel'];
    $description = htmlspecialchars($_POST['description']);

    $stmt = $pdo->prepare("INSERT INTO rappels (id_utilisatrice, type_rappel ,titre, date_rappel, description) VALUES (?,?,?,?,?)");
    $stmt->execute([$id_user, $type_rappel, $titre, $date_rappel, $description]);

    header("Location:../views/rappels.php");
    exit();
}

if (isset($_POST['valider_rappel'])) {
    $id_du_rappel = $_POST['id_du_rappel'];
    $stmt = $pdo->prepare("UPDATE rappels SET est_termine = 1 WHERE id = ? AND id_utilisatrice = ?");
    $stmt->execute([$id_user, $id_du_rappel]);

    header("Location:../views/rappels.php");
    exit();
}

 $stmt = $pdo->prepare("SELECT * FROM rappels WHERE id_utilisatrice = ? ORDER BY date_rappel ASC");
 $stmt->execute([$id_user]);
 $evements_medicaux = $stmt->fetchAll();

    

   


      
    


?>
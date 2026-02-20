<?php
require_once '../config/db.php';
session_start();

$id_user = $_SESSION['user_id'];
$date_jour = date('Y-m-d'); 

if (isset($_POST['ajouter_mouvement'])) {
    $check = $pdo->prepare("SELECT id FROM journal WHERE id_utilisatrice = ? AND DATE(date_enregistrement) = ?");
    $check->execute([$id_user, $date_jour]);
    $exists = $check->fetch();

    if ($exists) {
        
        $stmt = $pdo->prepare("UPDATE journal SET mouvements_bebe = mouvements_bebe + 1 WHERE id_utilisatrice = ? AND DATE(date_enregistrement) = ?");
        $stmt->execute([$id_user, $date_jour]);
    } else {
        
        $stmt = $pdo->prepare("INSERT INTO journal (id_utilisatrice, mouvements_bebe, date_enregistrement) VALUES (?, 1, NOW())");
        $stmt->execute([$id_user]);
    }
}

if (isset($_POST['reinitialiser_mouvements'])) {
    $stmt = $pdo->prepare("UPDATE journal SET mouvements_bebe = 0 WHERE id_utilisatrice = ? AND DATE(date_enregistrement) = ?");
    $stmt->execute([$id_user, $date_jour]);
}

header("Location: ../views/page_journal.php");
exit();



?>
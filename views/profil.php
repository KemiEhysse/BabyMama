<?php
require_once '../config/db.php';
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$id_user = $_SESSION['user_id'];

if (isset($_POST['update_profil'])) {
    $hopital = htmlspecialchars($_POST['hopital_suivi']);
    $date_accouchement = $_POST['date_accouchement'];

    $stmtUpdate = $pdo->prepare("UPDATE utilisatrices SET hopital_suivi = ?, date_accouchement = ? WHERE id = ?");
    $stmtUpdate->execute([$hopital, $date_accouchement, $id_user]);

    header("Location: ../views/page_profil.php?status=success");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: ../login.php");
    exit();
}

$stmtUser = $pdo->prepare("SELECT prenom, hopital_suivi, date_accouchement FROM utilisatrices WHERE id = ?");
$stmtUser->execute([$id_user]);
$user = $stmtUser->fetch();

$stmtMed = $pdo->prepare("SELECT nom, specialite, contact FROM medecins LIMIT 2");
$stmtMed->execute();
$mes_medecins = $stmtMed->fetchAll();

?>
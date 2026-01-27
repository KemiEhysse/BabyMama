<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_conseil'])) {
    
    // Récupération des données du formulaire
    $id_conseil = $_POST['id_conseil'];
    $nouvel_intitule = $_POST['intitule'];
    $nouveau_contenu = $_POST['contenu'];

    // Mise à jour de la table 'conseils'
    try {
        $sql = "UPDATE conseils SET intitule = ?, contenu = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nouvel_intitule, $nouveau_contenu, $id_conseil]);

        header('Location: gestion.php?msg=update_success');
    } catch (PDOException $e) {
        // message d'erreur
        header('Location: gestion.php?msg=update_error');
    }
    exit();
}
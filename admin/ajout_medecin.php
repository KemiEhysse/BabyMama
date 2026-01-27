<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $nom = htmlspecialchars($_POST['nom']);
    $specialite = htmlspecialchars($_POST['specialite']);
    $contact = htmlspecialchars($_POST['contact']);
    $hopital = htmlspecialchars($_POST['hopital']);

    if (!empty($nom) && !empty($contact)) {
        try {
            $sql = "INSERT INTO medecins (nom, specialite, contact, hopital) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nom, $specialite, $contact, $hopital]);

            header('Location: gestion.php?msg=add_success');
        } catch (PDOException $e) {
            header('Location: gestion.php?msg=error');
        }
    } else {
        header('Location: gestion.php?msg=empty_fields');
    }
    exit();
}
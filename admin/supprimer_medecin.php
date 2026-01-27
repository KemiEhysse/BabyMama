<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../auth/login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id_medecin = $_GET['id'];

    try {
        $sql = "DELETE FROM medecins WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_medecin]);

        header('Location: gestion.php?msg=delete_success');
    } catch (PDOException $e) {
        // Erreur probable : le médecin est déjà lié à une utilisatrice
        header('Location: gestion.php?msg=delete_error_linked');
    }
    exit();
}
<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // AJOUT D'UN MÉDECIN
    if (isset($_POST['ajouter_medecin'])) {
        $stmt = $pdo->prepare("INSERT INTO medecins (nom, specialite, contact, hopital) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['nom'], $_POST['spec'], $_POST['tel'], $_POST['hopital']]);
    }

    // SUPPRESSION D'UN MÉDECIN
    if (isset($_POST['supprimer_medecin'])) {
        $stmt = $pdo->prepare("DELETE FROM medecins WHERE id = ?");
        $stmt->execute([$_POST['id_medecin']]);
    }

    // MODIFICATION D'UN CONSEIL EXISTANT (lié aux symptômes)
    if (isset($_POST['modifier_conseil'])) {
        $stmt = $pdo->prepare("UPDATE conseils SET intitule = ?, contenu = ? WHERE id = ?");
        $stmt->execute([$_POST['intitule'], $_POST['contenu'], $_POST['id_conseil']]);
    }
}

/**
 * 3. RÉCUPÉRATION DES DONNÉES POUR LE FRONT
 */

// A. Liste des utilisatrices avec leurs médecins (Jointure)
$queryUsers = "SELECT u.id, u.nom, u.prenom, u.email, m.nom AS nom_medecin 
               FROM utilisatrices u 
               LEFT JOIN medecins m ON u.id_medecin = m.id 
               WHERE u.est_admin = 0";
$utilisatrices = $pdo->query($queryUsers)->fetchAll();

// B. Liste des médecins
$medecins = $pdo->query("SELECT * FROM medecins")->fetchAll();

// C. Liste des conseils et leurs symptômes associés
$queryConseils = "SELECT c.*, s.libelle AS symptome_associe 
                  FROM conseils c 
                  LEFT JOIN symptomes s ON s.id_conseil = c.id";
$conseils = $pdo->query($queryConseils)->fetchAll();


 //4. BOUTON RETOUR DASHBOARD
 // C'est une simple redirection vers l'accueil. On met juste le chemin.

?>
<?php
require_once '../config/db.php';
$conseil_prive = null;

if (isset($_GET['id_s'])) {
    $id_s = $_GET['id_s'];
    $id_u = 3; 

    // Enregistrement dans le journal
    $sql = "INSERT INTO journal_symptomes (id_utilisatrice, id_symptome) VALUES (:u, :s)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['u' => $id_u, 's' => $id_s]);

    // RÉCUPÉRATION DU CONSEIL (Correction faite ici)
    $sql_c = "SELECT s.libelle, c.contenu 
              FROM symptomes s 
              JOIN conseils c ON s.id_conseil = c.id 
              WHERE s.id = :id_s";
    
    $query_c = $pdo->prepare($sql_c);
    $query_c->execute(['id_s' => $id_s]);
    $conseil_prive = $query_c->fetch(PDO::FETCH_ASSOC);
}
?>
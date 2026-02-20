<?php

ini_set('display_errors', 0);
header('Content-Type: application/json');

try {
    // Connexion à la base de données
    require_once '../config/db.php';

    // On récupère le message envoyé par le JavaScript
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (empty($message)) {
        echo json_encode(['reply' => "Dites-moi ce que vous ressentez."]);
        exit;
    }
    $sql = "SELECT s.libelle, c.contenu 
            FROM symptomes s 
            JOIN conseils c ON s.id_conseil = c.id 
            WHERE s.libelle LIKE :msg 
            OR c.contenu LIKE :msg 
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['msg' => '%' . $message . '%']);
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultat) {
        $reponse = $resultat['contenu'];
    } else {
        $reponse = "Désolé je ne connais pas encore ce symptôme. Essayez un autre .";
    }

    echo json_encode(['reply' => $reponse]);

} catch (Exception $e) {
    echo json_encode(['reply' => "Erreur technique : " . $e->getMessage()]);
}
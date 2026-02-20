s<?php
require_once '../config/db.php';

$sql = "SELECT r.*, u.email
        From rappel r
        JOIN utilisatrices u ON r.id_utilisatrice = u.id
        WHERE r.date_rappel BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 HOUR)
        AND r.email_envoye = 0";

$stmt = $pdo->query($sql);                  
$rappels_imminents = $stmt->fetchAll();

foreach ($rappels_imminents as $rappel) {
    $to = $rappel['email'];
    $sujet = "Rappel BabyMama : " . $rappel['titre'];
    $message = "Bonjour ! N'oubliez pas votre " . $rappel['type_rappel'] . "prévu a " . $rappel['date_rappel'] . ". Instructions : " . $rappel['instructions'];

    if (mail($to, $sujet, $message, )){
        $update = $pdo->prepare("UPDATE rappels SET email_envoye = 1 WHERE id = ?");
        $update->execute([$rappel['id']]);
    }
}
?>
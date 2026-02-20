<?php
require_once '../config/db.php';

session_start();

$id_user = $_SESSION['user_id'];
$date_jour = date('Y-m-d');

if (isset($_POST['enregistrer_note'])) {
    $note = htmlspecialchars($_POST['note_libre']);
    $nom_image = null;

    
    if (isset($_FILES['image_journal']) && $_FILES['image_journal']['error'] == 0) {
        $dossier_destination = "../uploads/"; 
        
      
        $extension = pathinfo($_FILES['image_journal']['name'], PATHINFO_EXTENSION);
        $nom_image = "journal_" . $id_user . "_" . time() . "." . $extension;
        
       
        move_uploaded_file($_FILES['image_journal']['tmp_name'], $dossier_destination . $nom_image);
    }

   
    $check = $pdo->prepare("SELECT id, image_path FROM journal WHERE id_utilisatrice = ? AND DATE(date_enregistrement) = ?");
    $check->execute([$id_user, $date_jour]);
    $ligne_existante = $check->fetch();

    if ($ligne_existante) {
        
        if ($nom_image) {
            $stmt = $pdo->prepare("UPDATE journal SET note_libre = ?, image_path = ? WHERE id = ?");
            $stmt->execute([$note, $nom_image, $ligne_existante['id']]);
        } else {
            
            $stmt = $pdo->prepare("UPDATE journal SET note_libre = ? WHERE id = ?");
            $stmt->execute([$note, $ligne_existante['id']]);
        }
    } else {
        $stmt = $pdo->prepare("INSERT INTO journal (id_utilisatrice, note_libre, image_path, date_enregistrement) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$id_user, $note, $nom_image]);
    }

    header("Location: ../views/page_journal.php");
    exit();
}
?>
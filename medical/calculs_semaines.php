<?php
require_once '../config/db.php';

$sql = "SELECT prenom, etat_grossesse FROM utilisatrices WHERE id = 3";
$requetes = $pdo->prepare($sql);
$requetes->execute();
$utilisatrice = $requetes->fetch(PDO::FETCH_ASSOC);

if ($utilisatrice) {
    echo "<h1>Bienvenue, " . htmlspecialchars($utilisatrice['prenom']) . "!</h1>";

    if (!empty($utilisatrice['etat_grossesse'])) {
        
        $date_bdd = $utilisatrice['etat_grossesse'];
        $today = date_create('now');
        $date_dpa = date_create($date_bdd);
        date_modify($date_dpa, '+280 days');
        $diff = date_diff($today, $date_dpa);
        $jours_restants = (int)$diff->format('%r%a');

        if ($jours_restants < 0) {
            $jours_depasses = abs($jours_restants); 
            echo "<div style='background: #fff5f5; border: 2px solid #feb2b2; padding: 15px; border-radius: 10px; color: #c53030;'>";
            echo "<h3>Bébé prend son temps ! ✨</h3>";
            echo "Vous avez dépassé votre terme de <strong>" . $jours_depasses . " jour(s)</strong>.</div>";
        } elseif ($jours_restants == 0) {
            echo "<div style='background: #f0fff4; border: 2px solid #9ae6b4; padding: 15px; border-radius: 10px; color: #276749;'>";
            echo "<h3>C'est pour aujourd'hui ! 🎉</h3></div>";
        } else {
            echo "Il vous reste environ " . $diff->format('%a') . " jours avant l'accouchement.<br>";
            echo "Votre DPA est le : " . date_format($date_dpa, 'd/m/Y') . "<br><br>";
        }

        // --- ÉTAPE 1 : COMPTER LES SYMPTÔMES UNIQUES DU JOUR ---
        $sql_count = "SELECT COUNT(DISTINCT id_symptome) as total 
                      FROM journal_symptomes 
                      WHERE id_utilisatrice = 3 
                      AND DATE(date_enregistrement) = CURDATE()";
        $query_count = $pdo->query($sql_count);
        $resultat_count = $query_count->fetch();
        $nb_symptomes = $resultat_count['total'];

        // --- ÉTAPE 2 : AFFICHER LE COMPTEUR ---
        echo "<div style='font-weight: bold; color: #7b1fa2; margin-bottom: 15px;'>";
        echo "📊 " . $nb_symptomes . " symptôme(s) enregistré(s) aujourd'hui";
        echo "</div>";

        // --- ÉTAPE 3 : RÉCUPÉRER LE DERNIER POUR LE CONSEIL ---
        $sql_journal = "SELECT s.libelle, s.niveau_alerte, c.contenu 
                        FROM journal_symptomes j
                        JOIN symptomes s ON j.id_symptome = s.id
                        JOIN conseils c ON s.id = c.id_symptome
                        WHERE j.id_utilisatrice = 3 
                        AND DATE(j.date_enregistrement) = CURDATE()
                        ORDER BY j.date_enregistrement DESC 
                        LIMIT 1";
        
        $query_j = $pdo->query($sql_journal);
        $symptome = $query_j->fetch(PDO::FETCH_ASSOC);

        if ($symptome) {
            echo "<h3>Dernier symptôme enregistré : " . htmlspecialchars($symptome['libelle']) . "</h3>";
            if ($symptome['niveau_alerte'] == 3) {
                echo "<div style='color: white; background: #e53e3e; padding: 15px; border-radius: 10px;'>";
                echo "<strong>⚠️ ALERTE : </strong>" . htmlspecialchars($symptome['contenu']) . "</div>";
            } else {
                echo "<div style='color: #2b6cb0; border: 1px solid #2b6cb0; padding: 10px; border-radius: 10px;'>";
                echo "<strong>Conseil : </strong>" . htmlspecialchars($symptome['contenu']) . "</div>";
            }
        } else {
            echo "<h3>Tout va bien aujourd'hui !</h3>";
            echo "<p>Vous n'avez pas encore enregistré de symptômes pour ce " . date('d/m/Y') . ".</p>";
        }

    } else {
        echo "Veuillez configurer votre date de début dans les paramètres.";
    } 
}
?>
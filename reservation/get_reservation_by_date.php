<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
require_once '../config/connect_database.php';

// Vérifie si la date a été envoyée depuis l'input date
if (isset($_GET['date']) && !empty($_GET['date'])) {
    // Obtient la date envoyée depuis l'input date
    $selected_date = $_GET['date'];

    // Requête pour récupérer les informations avec la date spécifique formatée
    $sql = "SELECT first_name, last_name, email, phone, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date, DATE_FORMAT(hour, '%H:%i') AS formatted_hour FROM reservation WHERE date = '$selected_date'";

    // Exécution de la requête
    $resultat = $con->query($sql);

    // Vérifier si des résultats sont retournés
    if ($resultat->num_rows > 0) {
        // Créer un tableau pour stocker les données
        $donnees = array();

        while ($row = $resultat->fetch_assoc()) {
            // Ajouter chaque ligne dans le tableau
            $donnees[] = $row;
        }

        // Convertir le tableau en format JSON
        $json_data = json_encode($donnees);

        // Afficher le JSON (ou enregistrer dans un fichier, etc.)
        echo $json_data;
    } else {
        echo "Aucune réservation trouvée pour la date sélectionnée.";
    }
} else {
    echo "Veuillez fournir une date valide.";
}

// Fermer la connexion à la base de données
$con->close();
?>

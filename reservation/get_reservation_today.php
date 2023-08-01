<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
require_once '../config/connect_database.php';

// Obtenez la date d'aujourd'hui au format 'YYYY-MM-DD'
$today = date('Y-m-d');

// Requête pour récupérer les informations avec la date d'aujourd'hui formatée
$sql = "SELECT first_name, last_name, email, phone, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date, DATE_FORMAT(hour, '%H:%i') AS formatted_hour FROM reservation WHERE date = '$today'";

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
    echo "Aucun enregistrement trouvé pour la date d'aujourd'hui.";
}

// Fermer la connexion à la base de données
$con->close();
?>

<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
require_once '../config/connect_database.php';

// Vérifier si l'ID du produit à supprimer est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer le produit de la base de données
    $deleteProductQuery = "DELETE FROM product WHERE id = $id";
    if ($con->query($deleteProductQuery) === TRUE) {
        echo "Le produit avec l'ID $id a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du produit : " . $con->error;
    }
} else {
    echo "ID de produit non spécifié ou invalide.";
}

$con->close();
?>
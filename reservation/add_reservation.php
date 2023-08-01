<?php
header('Content-Type: application/json');
require_once '../config/connect_database.php';


$response = array();

if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['date']) && !empty($_POST['hour']) && !empty($_POST['quantity'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $quantity = $_POST['quantity'];


    if ($firstName && $lastName && $email && $phone && $date && $hour && $quantity !== false) {
 

            $requete = $con->prepare('INSERT INTO reservation (first_name, last_name, email, phone, date, hour, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $requete->bind_param('ssssssi', $firstName, $lastName, $email, $phone, $date, $hour, $quantity);

            if($requete->execute()){
                $response['error'] = false;
                $response['message'] = "Réservation ajouté avec succès !";
            } else {
                $response['error'] = true;
                $response['message'] = "La réservation n'a pas pu être ajouté";
            }

    } else {
        $response['error'] = true;
        $response['message'] = "Les données saisies sont invalides.";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Veuillez renseigner les informations.";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>

